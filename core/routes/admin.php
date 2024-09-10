<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BookingImport;
use App\Models\BedType;
use App\Models\Booking;
use App\Models\Room;
use App\Models\NewBedType;
use App\Models\BedAccessory;
use App\Models\Status;



Route::namespace('Auth')->group(function () {
    
    
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });

    // Admin Password Reset
    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('reset');
        Route::post('reset', 'sendResetCodeEmail');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('ResetPasswordController')->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'reset')->name('password.change');
    });

});

Route::middleware('admin', 'adminPermission')->group(function () {
    
    Route::post('/accommodation-change', function(){
        auth()->guard('admin')->user()->update([
            'accommodation_id' => request()->admin_accommodation_id    
        ]);
        
        $notify[] = ['success', 'Accommodation changed successfully !!!'];
        return back()->withNotify($notify);
    })->name('change_accommodation');
    
    Route::get('/room/status/change/{id}/{status}', function($id,$status){
        $beds = Status::findOrFail($id)->update([
            'status' => $status
            ]);
        return back();
        
    })->name('room.status.change');
    
    Route::get('/get-bookings/{staff_id}', function($staff_id){
        $beds = Booking::whereStatus(1)->whereUserId($staff_id)->get();
        return response()->json($beds);
    })->name('bookings.get');
    
    Route::get('/get-accessories/{accommodation_id}', function($accommodation_id){
        $beds = BedAccessory::whereAccommodationId($accommodation_id)->oldest('name')->get();
        return response()->json($beds);
    })->name('accessories.get');
    
    Route::get('/room/get-bed-accommodation/{accommodation_id}', function($accommodation_id){
        $data['beds'] = BedType::whereAccommodationId($accommodation_id)->oldest('bed_name')->get();
        $data['bedtypes'] = NewBedType::whereAccommodationId($accommodation_id)->oldest('name')->get();
        return response()->json($data);
    })->name('room.get');
    
    Route::get('/bed/get/{room_id}', function($room_id){
        
        $beds = Room::whereRoomId($room_id)->oldest('room_number')->get();
        
        return response()->json($beds);
        
    })->name('bed.get');
    
    Route::get('/templete/download', function(){
        
        $filePath = public_path('files/bookingTemplete.xlsx');

        $fileName = 'bookingTemplete.xlsx';

        return response()->download($filePath, $fileName);
        
    })->name('bookingTemplete');
    
    Route::post('/import_booking', function () {
        
        ini_set('max_execution_time', 3600);
        request()->validate([
            'importFile' => 'required'
        ]);
        Excel::import(new BookingImport, request()->file('importFile'));
        return redirect()->back();
    })->name('import.booking');


     Route::controller('AuthorizationController')->group(function () {
            Route::get('authorization', 'authorizeForm')->name('authorization');
            Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
            Route::post('verify-email', 'emailVerification')->name('verify.email');
        });
    

    Route::controller('AdminController')->group(function () {
        
        Route::get('room-status/list', 'statusIndex')->name('hotel.room.status.list');
        Route::post('room-status/save/{id?}', 'statusSave')->name('room.status.save');
        Route::post('room-status/delete/{id}', 'statusDelete')->name('room.status.delete');
        
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');
        Route::post('get-dashboard-data','getDashboardData')->name('get-dashboard-data');
        
        
        Route::get('lost-and-found-item','lostFounditem')->name('lostFounditem');
        Route::get('lost-and-found-item-create','lostFounditemcreate')->name('lostFounditemcreate');
        Route::post('lost-and-found-item-store','lostFounditemstore')->name('lostFounditemstore');
        Route::get('lost-and-found-item-edit/{id}','lostFounditemeedit')->name('lostFounditemedit');
        Route::get('lost-and-found-item-report/{id}','lostFounditemereport')->name('lostFounditemreport');
        Route::post('lost-and-found-item-update/{id}','lostFounditemeUpdate')->name('lostFounditemupdate');
        Route::post('lost-and-found-item-delete/{id}','lostFounditemeDelete')->name('lostFounditemdelete');
        
        
        
        Route::get('found-by','foundBy')->name('foundby');
        Route::get('found-by-create','foundBycreate')->name('foundbycreate');
        Route::post('found-by-store','foundbyStore')->name('foundbyStore');
        Route::get('found-by-edit/{id}','foundByedit')->name('foundbyedit');
        Route::post('found-by-update/{id}','foundbyUpdate')->name('foundbyupdate');
        Route::post('found-by-delete/{id}','foundByDelete')->name('foundbydelete');
        
        
        
        Route::get('handed-over-by','handedOverBy')->name('handedOverBy');
        Route::get('handed-over-by-create','handedOverBycreate')->name('handedOverBycreate');
        Route::post('handed-over-by-store','handedOverByStore')->name('handedOverBystore');
        Route::get('handed-over-by-edit/{id}','handedOverByedit')->name('handedOverByedit');
        Route::post('handed-over-by-update/{id}','handedOverByUpdate')->name('handedOverByupdate');
        Route::post('handed-over-by-delete/{id}','handedOverByDelete')->name('handedOverBydelete');
        
        
        
        
        Route::get('handed-over-to','handedOverto')->name('handedOverto');
        Route::get('handed-over-to-create','handedOvetocreate')->name('handedOvetocreate');
        Route::post('handed-over-to-store','handedOvetoStore')->name('handedOvetostore');
        Route::get('handed-over-to-edit/{id}','handedOvertoedit')->name('handedOvertoedit');
        Route::post('handed-over-to-update/{id}','handedOvertoUpdate')->name('handedOvertoupdate');
        Route::post('handed-over-to-edit/{id}','handedOvertoDelete')->name('handedOvertodelete');


        //Notification
        Route::get('notifications', 'notifications')->name('notifications');
        Route::get('notification/read/{id}', 'notificationRead')->name('notification.read');
        Route::get('notifications/read-all', 'readAll')->name('notifications.readAll');

        //Report Bugs
        Route::get('request-report', 'requestReport')->name('request.report');
        Route::post('request-report', 'reportSubmit')->name('request.report.submit');

        Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');
    });

    Route::controller('StaffController')->prefix('staff')->name('staff.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('transfer-Staff', 'transferStaff')->name('transferStaff');
        Route::post('save/{id?}', 'save')->name('save');
        Route::post('transferSave/{id?}', 'transferSave')->name('transferSave');
        Route::post('switch-status/{id}', 'status')->name('status');
        Route::get('login/{id}', 'login')->name('login');
    });

    Route::controller('RolesController')->prefix('roles')->name('roles.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('save/{id?}', 'save')->name('save');
    });

    // Users Manager
    Route::controller('ManageUsersController')->name('users.')->prefix('guests')->group(function () {
        Route::get('transfer-Guest', 'transferStaff')->name('transfer');
        Route::post('transferSave/{id?}', 'transferSave')->name('transferSave');
        Route::get('all', 'allUsers')->name('all');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('active', 'activeUsers')->name('active');
        Route::get('banned', 'bannedUsers')->name('banned');
        Route::get('email-verified', 'emailVerifiedUsers')->name('email.verified');
        Route::get('email-unverified', 'emailUnverifiedUsers')->name('email.unverified');
        Route::get('mobile-unverified', 'mobileUnverifiedUsers')->name('mobile.unverified');
        Route::get('mobile-verified', 'mobileVerifiedUsers')->name('mobile.verified');
        Route::get('mobile-verified', 'mobileVerifiedUsers')->name('mobile.verified');
        Route::get('detail/{id}', 'detail')->name('detail');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('send-notification/{id}', 'showNotificationSingleForm')->name('notification.single');
        Route::post('send-notification/{id}', 'sendNotificationSingle')->name('notification.single');
        Route::get('login/{id}', 'login')->name('login');
        Route::post('status/{id}', 'status')->name('status');

        Route::get('send-notification', 'showNotificationAllForm')->name('notification.all');
        Route::post('send-notification', 'sendNotificationAll')->name('notification.all.send');
        Route::get('notification-log/{id}', 'notificationLog')->name('notification.log');
    });

    Route::name('hotel.')->prefix('hotel')->group(function () {
        
        
        Route::controller('AmenitiesController')->name('amenity.')->prefix('amenities')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
            Route::get('/get-amenities/{accommodation_id}', 'getAmenities')->name('amenities');
        });

        //Bed
        Route::controller('BedTypeController')->name('bed.')->prefix('bed-list')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('delete/{id}', 'delete')->name('delete');
            Route::get('/get-bedType/{accommodation_id}', 'getBedType')->name('bedType');
            Route::get('/get-vacant/{accommodation_id}', 'getVacantBed')->name('vacant.bedType');
            Route::get('/occupied-beds','getOccupiedBed')->name('getOccupiedBed');
            Route::get('/vacant-beds','getVacantBed')->name('getVacantBed');
            
        });
        
        //New Bed Type
        Route::controller('NewBedTypeController')->name('newbed.')->prefix('new-bed-list')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::get('delete/{id}', 'delete')->name('delete');
            
        });
        
        
        //Bed Accessories
        Route::controller('BedAccessoriesController')->name('accessories.')->prefix('bed-accessories-list')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('delete/{id}', 'delete')->name('delete');
            Route::get('/get-bedType/{accommodation_id}', 'getBedType')->name('bedType');
            Route::get('/get-vacant/{accommodation_id}', 'getVacantBed')->name('vacant.bedType');
            Route::get('/occupied-beds','getOccupiedBed')->name('getOccupiedBed');
            Route::get('/vacant-beds','getVacantBed')->name('getVacantBed');
        });

        //Complement
        Route::controller('ComplementController')->name('complement.')->prefix('complements')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
        });

        //Room Type
        Route::controller('RoomTypeController')->name('room.type.')->prefix('room-type')->group(function () {
            Route::get('', 'index')->name('all');
            Route::get('create', 'create')->name('create');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
            Route::get('/get-roomType/{accommodation_id}', 'getroomType')->name('roomType');
            
        });

        //Room
        Route::controller('RoomController')->name('room.')->prefix('room')->group(function () {
            Route::get('', 'index')->name('all');
             Route::post('save/{id?}', 'save')->name('save');
            Route::post('update/status/{id}', 'status')->name('status');
            Route::get('/get-room/{accommodation_id}', 'getroom')->name('room');
            Route::get('/occupied-rooms','getOccupiedRoom')->name('getOccupiedRoom');
            Route::get('/vacant-rooms','getVacantRoom')->name('getVacantRoom');
            Route::post('delete/{id}', 'delete')->name('delete');
        });
        
        //Room Key
        Route::controller('RoomKeyController')->name('roomKey.')->prefix('room-key')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::delete('delete/{id}', 'delete')->name('delete');
        });
        
        //Room Item
         Route::controller('RoomItemController')->name('room-item.')->prefix('room-item')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
            Route::get('/get-roomitems/{accommodation_id}', 'getRoomitems')->name('room_items');
            
            
            //RoomItem Inspection
            Route::get('inspection', 'inspection')->name('inspection');
            Route::post('store/{id?}', 'store')->name('store.inspection');
        });
        

        //Extra Services
        Route::controller('ExtraServiceController')->name('extra_services.')->prefix('extra-service')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
        });
        
        //Accommodation Route
         Route::controller('AccommodationController')->name('accommodations.')->prefix('accommodations')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('store', 'store')->name('store');
            Route::post('status/{id}', 'status')->name('status');
        });
    });

    Route::controller('BookRoomController')->group(function () {
        Route::get('book-room', 'room')->name('book.room');
        Route::post('room-book', 'book')->name('room.book');
        Route::get('room/search', 'searchRoom')->name('room.search');
        Route::post('/bookingCheckout', 'bookingCheckout')->name('bookingCheckout');
        
    });

    //Manage Reservation
    Route::controller('BookingController')->group(function () {
        Route::name('booking.')->prefix('booking')->group(function () {
            Route::post('booking-merge/{id}', 'mergeBooking')->name('merge');

            Route::get('bill-payment/{id}', 'paymentView')->name('payment');
            Route::post('bill-payment/{id}', 'payment')->name('payment');

            Route::get('booking-checkout/{id}', 'checkOutPreview')->name('checkout');
            Route::post('booking-checkout/{id}', 'checkOut')->name('checkout');

            Route::get('booked-rooms/{id}', 'bookedRooms')->name('booked.rooms');
            Route::get('extra-service/details/{id}', 'extraServiceDetail')->name('service.details');

            Route::get('details/{id}', 'bookingDetails')->name('details');
            Route::get('booking-invoice/{id}', 'generateInvoice')->name('invoice');

            Route::post('key/handover/{id}', 'handoverKey')->name('key.handover');
            

        });
    });
    


    Route::name('booking.')->prefix('booking')->group(function () {
        Route::controller('BookingController')->group(function () {
            Route::get('all-bookings', 'allBookingList')->name('all');
            Route::get('approved', 'activeBookings')->name('active');
            Route::get('canceled-bookings', 'canceledBookingList')->name('canceled.list');
            Route::get('checked-out-booking', 'checkedOutBookingList')->name('checked.out.list');
            Route::get('todays/booked-room', 'todaysBooked')->name('todays.booked');
            Route::get('todays/check-in', 'todayCheckInBooking')->name('todays.checkin');
            Route::get('todays/checkout', 'todayCheckoutBooking')->name('todays.checkout');
            Route::get('refundable', 'refundableBooking')->name('refundable');
            Route::get('checkout/delayed', 'delayedCheckout')->name('checkout.delayed');
            Route::get('details/{id}', 'bookingDetails')->name('details');
            Route::get('booked-rooms/{id}', 'bookedRooms')->name('booked.rooms');
        });

        Route::controller('ManageBookingController')->group(function () {
            Route::post('key/handover/{id}', 'handoverKey')->name('key.handover');
            Route::post('booking-merge/{id}', 'mergeBooking')->name('merge');
            Route::get('bill-payment/{id}', 'paymentView')->name('payment');
            Route::post('bill-payment/{id}', 'payment')->name('payment');
            Route::post('add-charge/{id}', 'addExtraCharge')->name('extra.charge.add');
            Route::post('subtract-charge/{id}', 'subtractExtraCharge')->name('extra.charge.subtract');
            Route::get('booking-checkout/{id}', 'checkOutPreview')->name('checkout');
            Route::post('booking-checkout/{id}', 'checkOut')->name('checkout');
            Route::get('extra-service/details/{id}', 'extraServiceDetail')->name('service.details');
            Route::get('booking-invoice/{id}', 'generateInvoice')->name('invoice');
        });

        Route::controller('CancelBookingController')->group(function () {
            Route::get('cancel/{id}', 'cancelBooking')->name('cancel');
            Route::post('cancel-full/{id}', 'cancelFullBooking')->name('cancel.full');
            Route::post('booked-room/cancel/{id}', 'cancelSingleBookedRoom')->name('booked.room.cancel');
            Route::post('cancel-booking/{id}', 'cancelBookingByDate')->name('booked.day.cancel');
        });
    });

    Route::controller('BookingController')->prefix('booking')->group(function () {
        Route::get('upcoming/check-in', 'upcomingCheckIn')->name('upcoming.booking.checkin');
        Route::get('upcoming/checkout', 'upcomingCheckout')->name('upcoming.booking.checkout');
        Route::get('pending/check-in', 'pendingCheckIn')->name('pending.booking.checkin');
        Route::get('delayed/checkout', 'delayedCheckouts')->name('delayed.booking.checkout');
    });

    Route::controller('BookingExtraServiceController')->prefix('extra-service')->name('extra.service.')->group(function () {
        Route::get('all', 'list')->name('list');
        Route::get('add-new', 'addNew')->name('add');
        Route::post('add', 'addService')->name('save');
        Route::post('delete/{id}', 'delete')->name('delete');
    });

    Route::controller('ManageBookingRequestController')->prefix('booking')->name('request.booking.')->group(function () {
        Route::get('requests', 'index')->name('all');
        Route::get('request/canceled', 'canceledBookings')->name('canceled');
        Route::get('request/approve/{id}', 'approve')->name('approve');
        Route::post('request/cancel/{id}', 'cancel')->name('cancel');
        Route::post('assign-room', 'assignRoom')->name('assign.room');
    });

    // Subscriber
    Route::controller('SubscriberController')->prefix('subscriber')->name('subscriber.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('send-email', 'sendEmailForm')->name('send.email');
        Route::post('remove/{id}', 'remove')->name('remove');
        Route::post('send-email', 'sendEmail')->name('send.email');
    });


    // Deposit Gateway
    Route::name('gateway.')->prefix('gateway')->group(function () {
        // Automatic Gateway
        Route::controller('AutomaticGatewayController')->prefix('automatic')->name('automatic.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{alias}', 'edit')->name('edit');
            Route::post('update/{code}', 'update')->name('update');
            Route::post('remove/{id}', 'remove')->name('remove');
            Route::post('status/{id}', 'status')->name('status');
        });

        // Manual Methods
        Route::controller('ManualGatewayController')->prefix('manual')->name('manual.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('new', 'create')->name('create');
            Route::post('new', 'store')->name('store');
            Route::get('edit/{alias}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::post('status/{id}', 'status')->name('status');
        });
    });


    // PAYMENT SYSTEM
    Route::controller('DepositController')->prefix('payment')->name('deposit.')->group(function () {
        Route::get('/', 'deposit')->name('list');
        Route::get('pending', 'pending')->name('pending');
        Route::get('rejected', 'rejected')->name('rejected');
        Route::get('approved', 'approved')->name('approved');
        Route::get('successful', 'successful')->name('successful');
        Route::get('failed', 'failed')->name('failed');
        Route::get('details/{id}', 'details')->name('details');
        Route::post('reject', 'reject')->name('reject');
        Route::post('approve/{id}', 'approve')->name('approve');
    });

    // Report
    Route::controller('ReportController')->prefix('report')->name('report.')->group(function () {
        Route::get('login/history', 'loginHistory')->name('login.history');
        Route::get('login/ipHistory/{ip}', 'loginIpHistory')->name('login.ipHistory');
        Route::get('notification/history', 'notificationHistory')->name('notification.history');
        Route::get('email/detail/{id}', 'emailDetails')->name('email.details');
        Route::get('booking-actions', 'bookingSituationHistory')->name('booking.history');
        Route::get('payments/received/history', 'paymentsReceived')->name('payments.received');
        Route::get('payment/returned/history', 'paymentReturned')->name('payments.returned');
        Route::get('/bed-accommodation-count', 'bed_count_report')->name('bedCountReport');
        Route::get('/lost-found-item', 'lost_found_report')->name('lostFoundReport');
        Route::get('/booking', 'booking_report')->name('booking');
    });


    // Admin Support
    Route::controller('SupportTicketController')->prefix('ticket')->name('ticket.')->group(function () {
        Route::get('/', 'tickets')->name('index');
        Route::get('pending', 'pendingTicket')->name('pending');
        Route::get('closed', 'closedTicket')->name('closed');
        Route::get('answered', 'answeredTicket')->name('answered');
        Route::get('view/{id}', 'ticketReply')->name('view');
        Route::post('reply/{id}', 'replyTicket')->name('reply');
        Route::post('close/{id}', 'closeTicket')->name('close');
        Route::get('download/{ticket}', 'ticketDownload')->name('download');
        Route::post('delete/{id}', 'ticketDelete')->name('delete');
        Route::post('store', 'store')->name('store');
    });

    // Language Manager
    Route::controller('LanguageController')->prefix('language')->name('language.')->group(function () {
        Route::get('/', 'langManage')->name('manage');
        Route::post('/', 'langStore')->name('manage.store');
        Route::post('delete/{id}', 'langDelete')->name('manage.delete');
        Route::post('update/{id}', 'langUpdate')->name('manage.update');
        Route::get('edit/{id}', 'langEdit')->name('key');
        Route::post('import', 'langImport')->name('import.lang');
        Route::post('store/key/{id}', 'storeLanguageJson')->name('store.key');
        Route::post('delete/key/{id}', 'deleteLanguageJson')->name('delete.key');
        Route::post('update/key/{id}', 'updateLanguageJson')->name('update.key');
        Route::get('get-keys', 'getKeys')->name('get.key');
    });

    Route::controller('GeneralSettingController')->group(function () {
        // General Setting
        Route::get('general-setting', 'index')->name('setting.index');
        Route::post('general-setting', 'update')->name('setting.update');

        //configuration
        Route::get('setting/system-configuration', 'systemConfiguration')->name('setting.system.configuration');
        Route::post('setting/system-configuration', 'systemConfigurationSubmit')->name('setting.system.configuration.submit');

        // Logo-Icon
        Route::get('setting/logo-icon', 'logoIcon')->name('setting.logo.icon');
        Route::post('setting/logo-icon', 'logoIconUpdate')->name('setting.logo.icon');

        //Custom CSS
        Route::get('custom-css', 'customCss')->name('setting.custom.css');
        Route::post('custom-css', 'customCssSubmit')->name('setting.custom.css.submit');

        //Cookie
        Route::get('cookie', 'cookie')->name('setting.cookie');
        Route::post('cookie', 'cookieSubmit')->name('setting.cookie.submit');

        //maintenance_mode
        Route::get('maintenance-mode', 'maintenanceMode')->name('maintenance.mode');
        Route::post('maintenance-mode', 'maintenanceModeSubmit')->name('maintenance.mode.submit');
    });

    //Notification Setting
    Route::name('setting.notification.')->controller('NotificationController')->prefix('notification')->group(function () {
        //Template Setting
        Route::get('global', 'global')->name('global');
        Route::post('global/update', 'globalUpdate')->name('global.update');
        Route::get('templates', 'templates')->name('templates');
        Route::get('template/edit/{id}', 'templateEdit')->name('template.edit');
        Route::post('template/update/{id}', 'templateUpdate')->name('template.update');

        //Email Setting
        Route::get('email/setting', 'emailSetting')->name('email');
        Route::post('email/setting', 'emailSettingUpdate')->name('email.update');
        Route::post('email/test', 'emailTest')->name('email.test');

        //SMS Setting
        Route::get('sms/setting', 'smsSetting')->name('sms');
        Route::post('sms/setting', 'smsSettingUpdate')->name('sms.update');
        Route::post('sms/test', 'smsTest')->name('sms.test');
    });

    // Plugin
    Route::controller('ExtensionController')->prefix('extensions')->name('extensions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('status/{id}', 'status')->name('status');
    });


    //System Information
    Route::controller('SystemController')->name('system.')->prefix('system')->group(function () {
        Route::get('support', 'support')->name('support');
        Route::get('info', 'systemInfo')->name('info');
        Route::get('server-info', 'systemServerInfo')->name('server.info');
        Route::get('optimize', 'optimize')->name('optimize');
        Route::get('optimize-clear', 'optimizeClear')->name('optimize.clear');
    });

    // SEO
    Route::get('seo', 'FrontendController@seoEdit')->name('seo');


    // Frontend
    Route::name('frontend.')->prefix('frontend')->group(function () {
        Route::controller('FrontendController')->group(function () {
            Route::get('templates', 'templates')->name('templates');
            Route::post('templates', 'templatesActive')->name('templates.active');
            Route::get('frontend-sections/{key}', 'frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'frontendElement')->name('sections.element');
            Route::post('remove/{id}', 'remove')->name('remove');
        });

        // Page Builder
        Route::controller('PageBuilderController')->group(function () {
            Route::get('manage-pages', 'managePages')->name('manage.pages');
            Route::post('manage-pages', 'managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete/{id}', 'managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'manageSectionUpdate')->name('manage.section.update');
        });
    });
});
