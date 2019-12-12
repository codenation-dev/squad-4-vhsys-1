<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Request\UsersRequest;
use App\Services\Contracts\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginJwtController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $data = $this->userService->login($request->all(['email', 'password']));

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function register(UsersRequest $request)
    {
        $data = $this->userService->create($request->all(['name', 'password', 'email', 'admin']));

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }
}
