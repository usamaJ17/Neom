<?php

namespace App\Providers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Booking;
use App\Models\Deposit;
use App\Models\Frontend;
use App\Models\BookingRequest;
use App\Models\SupportTicket;
use App\Models\User;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $general        = Cache::get('GeneralSetting');
        $general        = gs();
        $activeTemplate = activeTemplate();

        $viewShare['general']            = $general;
        $viewShare['activeTemplate']     = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['emptyMessage']       = 'No data found';
        $viewShare['bookingRequestCount']       = BookingRequest::initial()->count();

        view()->share($viewShare);

        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'bannedUsersCount'           => User::banned()->count(),
                'emailUnverifiedUsersCount'  => User::emailUnverified()->count(),
                'mobileUnverifiedUsersCount' => User::mobileUnverified()->count(),
                'pendingTicketCount'         => SupportTicket::whereIN('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count(),
                'pendingDepositsCount'       => Deposit::pending()->count(),
                'delayedCheckoutCount'       => Booking::delayedCheckout()->count(),
                'refundableBookingCount'     => Booking::refundable()->count(),
                'pendingCheckInsCount'    => Booking::active()->keyNotGiven()->whereDate('check_in', '<=', now())->count()
            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'bookingRequestCount'    => BookingRequest::initial()->count(),
                'adminNotifications'     => AdminNotification::where('is_read', Status::NO)->with('user')->orderBy('id', 'desc')->take(10)->get(),
                'adminNotificationCount' => AdminNotification::where('is_read', Status::NO)->count(),
            ]);
        });


        view()->composer($activeTemplate . 'partials.header', function ($view) use ($activeTemplate) {
            $view->with([
                'pages' => Page::where('tempname', $activeTemplate)->where('is_default', 0)->get(),
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if ($general->force_ssl) {
            \URL::forceScheme('https');
        }


        Paginator::useBootstrapFour();
    }
}
