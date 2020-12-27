<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }

        if (! auth()->user()->isAdmin()) {
            flash('Доступ закрыт. Обратитесь к администратору.', 'danger');
            return redirect('/');
        }

        return $next($request);
    }
}
