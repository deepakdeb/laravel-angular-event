<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\OtpController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('guest')->except('logout');
    }//end function __construct

    /**
     * user login
     */

    public function login(Request $request)
    {
        $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me))
        {
            $user = auth()->user();
            
            return redirect()->intended('/');
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }//end function login

    /**
     * user logout
     */
    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }//end function logout
}//end class LoginController
