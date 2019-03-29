<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Where to redirect admin after login.
     *
     * @var string
     */
    protected $redirectToAdmin = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function authenticated()
    {
        /**
         * @var $user \App\Models\User
         */
        $user = auth()->user();

        if ($admin = \App\Models\Admin::newModelInstance($user)) {
            $this->addTokenToCookie($admin);

            return redirect()->intended($this->redirectToAdmin ?: '/admin');
        }

        return redirect()->intended($this->redirectTo ?: '/home');
    }

    private function addTokenToCookie(\App\Models\Admin $admin)
    {
        $token = \JWTAuth::fromUser($admin);
        $minutes = now()->addMinutes(\JWTFactory::getTTL() * config('jwt.ttl'))->timestamp;
        setcookie('token', $token, $minutes, $this->redirectToAdmin ?: '/admin');

        return $token;
    }
}
