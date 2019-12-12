<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\Exclusions\ExclusionsController;
use App\Http\Requests\Request\UsersRequest;
use App\Services\Contracts\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->all();

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function show($id)
    {
        $data = $this->userService->findById($id);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']);
    }

    public function update(UsersRequest $request, $id)
    {
        $dataNewUser = $request->all(['name', 'password', 'email']);

        $data = $this->userService->update($dataNewUser, $id);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']);
    }

    public function destroy($id)
    {
        $data = $this->userService->delete($id);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function listUserDeleted()
    {
        $data = $this->userService->usersDeleted();

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }
}
