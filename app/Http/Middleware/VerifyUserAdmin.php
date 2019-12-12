<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find(Auth::id());
        if ($user->admin != 1) {
            return response()->json(['data' => 'User does not have administrator profile']);
        }
        return $next($request);
    }
}
