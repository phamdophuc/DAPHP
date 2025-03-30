<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        // Kiểm tra nếu người dùng chưa đăng nhập hoặc không có role
        if (!$user || !$user->role) {
            abort(403, 'Unauthorized');
        }

        // Kiểm tra vai trò của người dùng
        if ($user->role->name === $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}