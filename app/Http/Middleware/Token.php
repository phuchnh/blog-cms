<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class Token
{
    use AuthenticatesUsers;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->cookie('token')) {
            return $next($request);
        }

        return $this->logout($request);
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
        try {
            if ($token = \JWTAuth::parseToken()) {
                auth('api')->logout();
            }
        } catch (JWTException $exception) {
            return redirect()->intended('/login')->cookie($cookie);
        }

        return redirect()->intended('/login')->cookie($cookie);
    }
}
