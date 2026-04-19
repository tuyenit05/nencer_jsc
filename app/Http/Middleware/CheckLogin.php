<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response 
    {
        //Kiểm tra xem user đã login hay chưa
        if (Auth::check()) {
            return $next($request);
        }
        //Chua login thì sẽ điều hướng về màn hình login
        return redirect('/login');
    }
}
