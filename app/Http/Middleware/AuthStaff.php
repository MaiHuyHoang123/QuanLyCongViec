<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check() || Auth::guard('staff')->check()) {
            // Người dùng đã đăng nhập, tiếp tục xử lý
            return $next($request);
        } else {
            // Người dùng chưa đăng nhập, chuyển hướng hoặc xử lý theo ý muốn
            return redirect('/login')->withErrors(['error' => 'Bạn cần đăng nhập để truy cập trang này.']);
        }
    }
}
