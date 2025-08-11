<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $routeName = $request->route()->getName();

        if (!$routeName) {
            abort(403, 'Route name is not defined.');
        }

        $hasPermission = DB::table('role_users')
            ->join('role_permissions', 'role_users.role_id', '=', 'role_permissions.role_id')
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_users.user_id', $user->id)
            ->where('permissions.route_name', $routeName)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
