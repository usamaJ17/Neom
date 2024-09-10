<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\User;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class DepositController extends Controller {
    public function pending() {
        $pageTitle = 'Pending Payments';
        $deposits = $this->depositData('pending');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function approved() {
        $pageTitle = 'Approved Payments';
        $deposits = $this->depositData('approved');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function successful() {
        $pageTitle = 'Successful Payments';
        $deposits = $this->depositData('successful');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function rejected() {
        $pageTitle = 'Rejected Payments';
        $deposits = $this->depositData('rejected');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function failed() {
        $pageTitle = 'Failed Payments';
        $deposits = $this->depositData('initiated');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function deposit() {
        $pageTitle   = 'Payment History';
        $depositData = $this->depositData($scope = null, $summery = true);
        $deposits    = $depositData['data'];
        $summery     = $depositData['summery'];
        $successful  = $summery['successful'];
        $pending     = $summery['pending'];
        $rejected    = $summery['rejected'];
        $initiated   = $summery['initiated'];
        return view('admin.deposit.log', compact('pageTitle', 'deposits', 'successful', 'pending', 'rejected', 'initiated'));
    }

    protected function depositData($scope = null, $summery = false) {
        if ($scope) {
            $deposits = Deposit::$scope()->with(['user', 'gateway', 'admin']);
        } else {
            $deposits = Deposit::with(['user', 'gateway', 'admin']);
        }
        $deposits = $deposits->searchable(['trx', 'user:username'])->dateFilter();

        $request = request();
        //vai method
        if ($request->method) {
            $method = Gateway::where('alias', $request->method)->firstOrFail();
            $deposits = $deposits->where('method_code', $method->code);
        }

        if (!$summery) {
            return $deposits->orderBy('id', 'desc')->get();
        } else {
            $successful = clone $deposits;
            $pending    = clone $deposits;
            $rejected   = clone $deposits;
            $initiated  = clone $deposits;

            $successfulSummery = $successful->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
            $pendingSummery    = $pending->where('status', Status::PAYMENT_PENDING)->sum('amount');
            $rejectedSummery   = $rejected->where('status', Status::PAYMENT_REJECT)->sum('amount');
            $initiatedSummery  = $initiated->where('status', Status::PAYMENT_INITIATE)->sum('amount');

            return [
                'data' => $deposits->orderBy('id', 'desc')->get(),
                'summery' => [
                    'successful' => $successfulSummery,
                    'pending'    => $pendingSummery,
                    'rejected'   => $rejectedSummery,
                    'initiated'  => $initiatedSummery,
                ]
            ];
        }
    }

    public function details($id) {
        $deposit = Deposit::where('id', $id)->with(['user', 'gateway'])->firstOrFail();
        $pageTitle = $deposit->user->username . ' requested ' . showAmount($deposit->amount) . ' ' . gs('cur_text');
        $details = ($deposit->detail != null) ? json_encode($deposit->detail) : null;
        return view('admin.deposit.detail', compact('pageTitle', 'deposit', 'details'));
    }


    public function approve($id) {
        $deposit = Deposit::where('id', $id)->where('status', Status::PAYMENT_PENDING)->firstOrFail();

        //action log
        bookingActionRecord($deposit->booking_id, auth()->guard('admin')->id(), 0, 'payment_approved');

        PaymentController::userDataUpdate($deposit, true);

        $notify[] = ['success', 'Payment request approved successfully'];

        return to_route('admin.deposit.pending')->withNotify($notify);
    }

    public function reject(Request $request) {
        $request->validate([
            'id' => 'required|integer',
            'message' => 'required'
        ]);
        $deposit = Deposit::where('id', $request->id)->where('status', Status::PAYMENT_PENDING)->firstOrFail();

        $deposit->admin_feedback = $request->message;
        $deposit->status = Status::PAYMENT_REJECT;
        $deposit->save();

        $user = User::find($deposit->user_id);
        $booking = Booking::find($deposit->booking_id);

        //action log
        bookingActionRecord($deposit->booking_id, auth()->guard('admin')->id(), 0, 'payment_reject');


        notify($user, 'PAYMENT_MANUAL_REJECT', [
            'booking_number'  => $booking->booking_number,
            'amount'          => showAmount($deposit->amount),
            'charge'          => showAmount($deposit->charge),
            'rate'            => $deposit->rate,
            'method_name'     => $deposit->gateway->name,
            'method_currency' => $deposit->method_currency,
            'method_amount'   => showAmount($deposit->final_amo)
        ]);

        $notify[] = ['success', 'Payment request rejected successfully'];
        return  to_route('admin.deposit.pending')->withNotify($notify);
    }
}
