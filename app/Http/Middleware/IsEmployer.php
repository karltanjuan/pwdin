<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;

class IsEmployer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (Auth::guard('employers')->check()) {
            // Retrieve the authenticated user
            $user = auth('employers')->user();

            $db_user = Employer::where('email', $user->email)->first();
        
            if ($user->email === $db_user['email']) {
                // Check if user's status is 1
                if ($user->status === 1) {
                    // User is logged in, email matches, and status is 1 then proceed to dashboard 
                    return $next($request);
                }
            }
        }

        return redirect('/employer/login');
    }
}
