<?php

namespace App\Http\Middleware\backend;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::guard('admin')->user()->super_admin==1) {
            return redirect('admin');
        }

        return $next($request);
    }
}
