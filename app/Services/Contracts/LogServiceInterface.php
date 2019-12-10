<?php


namespace App\Services\Contracts;


interface LogServiceInterface
{
    public function all();
    public function search(array $queryUrl);
    public function findById(int $id);
    public function create($log);
    public function toFile($id);
    public function filled();
    public function destroy ($id);
}
