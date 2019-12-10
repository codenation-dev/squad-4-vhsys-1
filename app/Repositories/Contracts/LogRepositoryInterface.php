<?php


namespace App\Repositories\Contracts;


use App\Log;

interface LogRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function create(array $log);
    public function search($queryUrl);
    public function filled();
    public function toFile(Log $log);
    public function forceDelete(Log $log);
}
