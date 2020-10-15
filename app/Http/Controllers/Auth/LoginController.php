<?php

namespace App\Http\Controllers\Auth;

use App\log_session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/panel';

    protected function authenticated($request,$user)
    {
        if(\Auth::user()){
            $userId = \Auth::id();
            $clientIP = \Request::ip();
            $log_session = new log_session();
            $log_session->id_user = $userId;
            $log_session->ip_user = $clientIP;
            $log_session->tipo = '1';
            $log_session->save();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected function logout()
    {

        $userId = \Auth::id();
        if($this->middleware('guest')->except('logout')){
            \Auth::logout();
            $clientIP = \Request::ip();
            $log_session = new log_session();
            $log_session->id_user = $userId;
            $log_session->ip_user = $clientIP;
            $log_session->tipo = '0';
            $log_session->save();
            return redirect('/');
        }


    }

    //public function __construct()
    //{
    //    $this->middleware('guest')->except('logout');
    //}
}
