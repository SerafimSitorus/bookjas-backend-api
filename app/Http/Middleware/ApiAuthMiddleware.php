<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$status): Response
    {

        $token = $request->header('Authorization');
        // $token = "2dcbd000-dca0-46a6-8377-253e9f8870ea";
        $authenticate = true;

        if (!$token) {
            $authenticate = false;
        }

        $user = User::where('token', $token)->first();

        if (!$user) {
            $authenticate = false;
        } else {
            Auth::login($user);
        }
        
        if ($authenticate && in_array($request->user()->status, $status)) {
            return $next($request);
        } else {
            return response()->json([
                "errors" => [
                    "message" => [
                        "Unauthorized"
                    ]
                ]
            ])->setStatusCode(401);
        }

    }
}
