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
        if (in_array(auth()->user()->type,  [\App\Models\Admin::ADMIN, \App\Models\Admin::EDITOR])) {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}
