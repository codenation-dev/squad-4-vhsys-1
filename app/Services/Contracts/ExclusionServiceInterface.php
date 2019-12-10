<?php


namespace App\Services\Contracts;


interface ExclusionServiceInterface
{
    public function all();
    public function findById(int $id);
    public function create($exclusion);
}
