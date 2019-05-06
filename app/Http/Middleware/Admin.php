<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->type === \App\Models\Admin::ADMIN || auth()->user()->type === 'editor') {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}
