<?php


namespace App\Services\Contracts;


interface LogServiceInterface
{
    public function search(array $queryUrl);
    public function findById(int $id);
}
