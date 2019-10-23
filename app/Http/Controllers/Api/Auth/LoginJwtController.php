<?php

namespace App\Http\Controllers\Api\Auth;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginJwtController extends Controller
{
    public function login(Request $request){
        $credentials = $request->all(['email','password']);
        if(!$token = auth('api')->attempt($credentials)){
            return response()->json(['status'=>'Não Autorizado!'],401);
        }
        return response()->json(
            [
                'status'=> 'OK',
                'token' => $token
            ],200);
    }
}
