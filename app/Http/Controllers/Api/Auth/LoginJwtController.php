<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Request\UsersRequest;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginJwtController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->all(['email', 'password']);

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['status' => 'ERROR', 'message' => 'Not Authorized'], 401);
            }
            $user = User::where('email', '=', $request['email'])->first();
            print_r($user['admin']); die;
            return response()->json(
                [
                    'status' => 'OK',
                    'user' => $user['name'],
                    'admin' => $user['admin'],
                    'token' => $token
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
    }

    public function register(UsersRequest $request)
    {
        try {
            if (User::where('email', $request['email'])->first()) {
                return response()->json([
                    'status' => 'ERROR',
                    'Message' => 'Registered User'
                ], 202);
            }
            $credentials = $request->all(['name', 'password', 'email','admin']);

            if (User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
                'admin' => empty($credentials['admin'])?0:1,

            ])) {
                return response()->json([
                    'status' => 'OK',
                    'Message' => 'Registered Successfully'
                ], 201);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
    }
}
