<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $adminEmail = (string) config('auth.admin_email');

        abort_unless(
            $user !== null
                && $adminEmail !== ''
                && strcasecmp($user->email, $adminEmail) === 0,
            403
        );

        return $next($request);
    }
}
