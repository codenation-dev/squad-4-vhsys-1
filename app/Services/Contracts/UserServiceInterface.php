<?php


namespace App\Services\Contracts;


interface UserServiceInterface
{
    public function all();
    public function findById(int $id);
    public function findByEmail(string $email);
    public function create($dataNewUser);
    public function update($data, $id);
    public function delete ($id);
    public function login($data);
    public function usersDeleted();
}
