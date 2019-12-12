<?php


namespace App\Repositories\Contracts;


interface ExclusionRepositoryInterface
{
    public function all();
    public function allByUser();
    public function findById(int $id);
    public function create(array $exclusion);
}
