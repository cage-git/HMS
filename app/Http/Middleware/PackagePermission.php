<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class PackagePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        $packagePermissionArray = pakage_permission();
        $requiredPermissions = explode('|', $permissions);
        $businessId = Auth::user()->business_id;
        if ($businessId !== null) {
            foreach ($requiredPermissions as $permission) {
                if (!in_array($permission, $packagePermissionArray)) {
                    return redirect()->route('access-denied');
                }
            }
        }

        return $next($request);
    }

}
