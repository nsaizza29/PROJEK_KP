<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !$user->is_approved) {
            if (!in_array($request->route()->getName(), ['not-approved', 'logout'])) {
                return redirect()->route('not-approved');
            }
        }
        return $next($request);
    }
}
