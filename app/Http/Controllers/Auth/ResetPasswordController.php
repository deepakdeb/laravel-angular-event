<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\OtpController;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * sent otp to email for password reset
    */
    public function sentEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|exists:users',
        ]);
        $otp = new OtpController;
        $otp->requestForOtp($request->email , 'reset-password');

        return redirect('/password/set?email=' . $request->email)->with([
            'success' => 'We have sent an otp in your email.Please check and paste'
        ]);

    }//end function sentEmail
}//end class ResetPasswordController