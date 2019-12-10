<?php


namespace App\Repositories\Contracts;


interface LogRepositoryInterface
{
    public function search($queryUrl);
    public function find(int $id);
}
