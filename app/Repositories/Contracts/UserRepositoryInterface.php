<?php


namespace App\Repositories\Contracts;


use App\User;

interface UserRepositoryInterface
{
    public function create(array $newUser);
    public function all();
    public function findById(int $id);
    public function findByEmail(string $email);
    public function update(User $user);
    public function delete(User $user);
    public function usersDeleted();
    public function userAdmin();
}
