<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Request\UsersRequest;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class LoginJwtController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']); 

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['status' => 'ERROR', 'message' => 'Not Authorized'], 401);
        }
        return response()->json(
            [
                'status' => 'OK',
                'token' => $token
            ], 200);
    }

    public function registrar(UsersRequest $request)
    {
        if (User::where('email', $request['email'])->first()) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Registered User'], 200);
        }
        $credentials = $request->all(['name', 'password', 'email']);

        if (User::create(['name' => $credentials['name'], 'email' => $credentials['email'], 'password' => Hash::make($credentials['password']),])) {
            return response()->json([
                'status' => 'OK',
                'Message' => 'Registered Successfully'], 201);
        }
        return response()->json([
            'status' => 'ERROR',
            'Message' => 'Error Registering'
        ], 200);
    }
}
