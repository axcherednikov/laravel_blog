<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }

        if (! auth()->user()->isAdmin()) {
            flash('Доступ закрыт. Обратитесь к администратору.', 'danger');

            return redirect(route('home'));
        }

        return $next($request);
    }
}
