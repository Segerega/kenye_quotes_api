<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class BearerTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !($user = User::where('api_token', $token)->first())) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $request->user = $user;
        return $next($request);
    }

}
