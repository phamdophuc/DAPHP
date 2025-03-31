<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        $user = $request->user();

        // Kiểm tra nếu chưa đăng nhập hoặc role_id không phải là 1 (admin)
        if (!$user || $user->role_id !== 1) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}
