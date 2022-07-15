<?php

namespace App\Http\Middleware;

use Closure;

class Account
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->accounts->count() == 0) {
            return redirect()->route('accounts.create');
        }
        return $next($request);
    }
}
