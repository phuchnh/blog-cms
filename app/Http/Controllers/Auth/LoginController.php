<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        if (in_array($user->type, [\App\Models\Admin::ADMIN, \App\Models\Admin::EDITOR])) {
            $credentials = $request->only(['email', 'password']);
            //$minutes = now()->addMinutes(\JWTFactory::getTTL() * config('jwt.ttl'))->timestamp;
            $minutes = now()->addMinutes(1)->timestamp;

            if ($token = auth('api')->attempt($credentials, ['exp' => $minutes])) {
                $options = ['/admin', null, false, false];
                $cookie = cookie('token', $token, $minutes, ...$options);
                return redirect()->intended($this->redirectToAdmin ?: '/admin')->cookie($cookie);
            }

            return redirect()->intended($this->redirectToAdmin ?: '/admin');
        }

        return redirect()->intended($this->redirectTo ?: '/home');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        $cookie = cookie()->forget('token');
        if ($request->hasHeader('Authorization')) {
            auth('api')->logout();
        }
        return redirect()->intended('/login')->cookie($cookie);
    }
}
