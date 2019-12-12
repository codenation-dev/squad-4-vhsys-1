<?php


namespace App\Services;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ExclusionServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $exclusionService;

    public function __construct(UserRepositoryInterface $userRepository, ExclusionServiceInterface $exclusionService)
    {
        $this->exclusionService = $exclusionService;
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        try{
            $user = $this->userRepository->all();

            return [
                'data' => $user,
                'code' => 200
            ];
        }catch (QueryException $exception) {
            return [
                'data' => 'An error occurred while processing the request',
                'code' => 503
            ];
        }
    }

    public function findById(int $id)
    {
        try{
            $user = $this->userRepository->findById($id);

            if(empty($user)){
                return [
                    'data' => 'Not found user',
                    'code' => 404
                ];
            }

            return [
                'data' => $user,
                'code' => 200
            ];
        }catch (QueryException $exception){
            return [
                'data' => 'An error occurred while processing the request',
                'code' => 503
            ];
        }
    }

    public function findByEmail(string $email)
    {
        try {
            $user = $this->userRepository->findByEmail($email);

            if(empty($user)){
                return [
                    'data' => 'Not found user',
                    'code' => 404
                ];
            }

            return [
                'data' => $user,
                'code' => 200
            ];
        }catch (QueryException $exception) {
            return [
                'data' => 'An error occurred while processing the request',
                'code' => 503
            ];
        }
    }

    public function usersDeleted()
    {
        $data = $this->userRepository->usersDeleted();

        return [
            'data' => $data,
            'code' => 200
        ];
    }

    public function create($dataNewUser)
    {
        $user = $this->findByEmail($dataNewUser['email']);

        if($user['code'] == 200){
            return [
                'data' => 'User already registered',
                'code' => 202
            ];
        }

        if($user['code'] != 404){
            return $user;
        }

        $newUser = [
            'name'      => $dataNewUser['name'],
            'email'     => $dataNewUser['email'],
            'password'  => Hash::make($dataNewUser['password']),
            'admin'     => empty($dataNewUser['admin']) ? 0 : 1
        ];

        try{
            $this->userRepository->create($newUser);

            return [
                'data' => 'User successfully registered',
                'code' => 201
            ];
        }catch (QueryException $e) {
            return [
                'data' => 'Unable to register user',
                'code' => 503
            ];
        }
    }

    public function delete ($id)
    {
        $user = $this->findById($id);

        if($user['code'] == 404){
            return $user;
        }

        $data = [
            'value' => json_encode($user['data']),
            'id_user' => $user['data']['id'],
            'type' => 'User'
        ];

        $exclusion = $this->exclusionService->create($data);

        if($exclusion['code'] == 503){
            return $exclusion;
        }

        try{
            $this->userRepository->delete($user['data']);

            return [
                'data' => 'User deleted successfully',
                'code' => 200
            ];

        }catch (QueryException $exception) {
            return [
                'data' => 'Unable to delete user',
                'code' => 503
            ];
        }
    }

    public function update($data, $id)
    {
        $user = $this->findById($id);

        if($user['code'] == 404){
            return $user;
        }

        $userAlt = Auth::user();

        $user['data']->name = $data['name'];
        $user['data']->email = $data['email'];
        $user['data']->password =  Hash::make($data['password']);
        $user['data']->id_user_alteracao = $userAlt['id'];

        try{
            $this->userRepository->update($user['data']);

            return [
                'data' => 'user updated successfully',
                'code' => 200
            ];
        }catch (QueryException $e) {
            return [
                'data' => 'Unable to update user',
                'code' => 503
            ];
        }
    }

    public function login($data) {
        if (!$token = auth('api')->attempt($data)) {
            return [
                'data' => 'Username or password is invalid',
                'code' => 401
            ];
        }

        $user = $this->findByEmail($data['email']);

        if($user['code'] != 200){
            return $user;
        }

        return [
            'data' => [
                'user' => $user['data']->name,
                'admin' => $user['data']->admin,
                'token' => $token
            ],

            'code' => 200
        ];
    }
}
