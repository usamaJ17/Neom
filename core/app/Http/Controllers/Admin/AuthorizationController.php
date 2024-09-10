<?php


namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;



class AuthorizationController extends Controller
{
   protected function checkCodeValidity($user, $addMin = 2)
{
    if (!$user->ver_code_send_at) {
        return false;
    }

    // Parse the string to a Carbon object
    $verCodeSendAt = Carbon::parse($user->ver_code_send_at);

    if ($verCodeSendAt->addMinutes($addMin)->isPast()) {
        return false;
    }

    return true;
}

    public function authorizeForm()
    {
        $user = auth()->guard('admin')->user();
        if (!$user->status) {
            $pageTitle = 'Banned';
            $type = 'ban';
        }elseif(!$user->ev) {
            $type = 'email';
            $pageTitle = 'Verify Email';
            $notifyTemplate = 'EVER_CODE';
        }else{
            return to_route('admin.dashboard');
        }

        if (!$this->checkCodeValidity($user) && ($type != '2fa') && ($type != 'ban')) {
            $user->ver_code = verificationCode(6);
            $user->ver_code_send_at = Carbon::now();
            $user->save();
            notify($user, $notifyTemplate, [
                'code' => $user->ver_code
            ],[$type]);
        }

        return view($this->activeTemplate.'user.auth.authorization.'.$type, compact('user', 'pageTitle'));

    }

    public function sendVerifyCode($type)
    {
        $user = auth()->guard('admin')->user();

        if ($this->checkCodeValidity($user)) {
            $verCodeSendAt = Carbon::parse($user->ver_code_send_at);
            $targetTime = $verCodeSendAt->addMinutes(2)->timestamp;
            $delay = $targetTime - time();
            throw ValidationException::withMessages(['resend' => 'Please try after ' . $delay . ' seconds']);
        }

        $user->ver_code = verificationCode(6);
        $user->ver_code_send_at = Carbon::now();
        $user->save();

        if ($type == 'email') {
            $type = 'email';
            $notifyTemplate = 'EVER_CODE';
        }

        notify($user, $notifyTemplate, [
            'code' => $user->ver_code
        ],[$type]);

        $notify[] = ['success', 'Verification code sent successfully'];
        return back()->withNotify($notify);
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'code'=>'required'
        ]);

        $user = auth()->guard('admin')->user();

        if ($user->ver_code == $request->code) {
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return to_route('admin.dashboard');
        }
        throw ValidationException::withMessages(['code' => 'Verification code didn\'t match!']);
    }

    public function mobileVerification(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);


        $user = auth()->guard('admin')->user();
        if ($user->ver_code == $request->code) {
            $user->sv = Status::VERIFIED;;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return to_route('admin.dashboard');
        }
        throw ValidationException::withMessages(['code' => 'Verification code didn\'t match!']);
    }
}
