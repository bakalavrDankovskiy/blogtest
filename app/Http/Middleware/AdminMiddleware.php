<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->isNotAdmin()) {
                return back()
                    ->withErrors('У вас нет прав, чтобы заходить в админ. раздел');
            }
            return $next($request);
        }
        return redirect(route('login'));
    }
}
