<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $newUser)
    {
        $this->model->create($newUser);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById(int $id)
    {
        return $this->model::find($id);
    }

    public function findByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function usersDeleted()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function update(User $user)
    {
        $user->save();
    }

    public function userAdmin()
    {
        $user = User::find(Auth::id());
        if ($user->admin != 1) {
            return 'user';
        }
    }
}
