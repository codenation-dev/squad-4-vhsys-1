<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;

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
        return $this->model->onlyTrashed()->with('User')->get();
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function update(User $user)
    {
        $user->save();
    }
}
