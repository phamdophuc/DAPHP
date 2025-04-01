<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Bạn chưa đăng nhập.');
        }
        if (Auth::user()->role !== $role) {
            abort(403, 'Vai trò không hợp lệ: ' . Auth::user()->role);
        }

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}
