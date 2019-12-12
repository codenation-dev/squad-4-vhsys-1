<?php


namespace App\Repositories;


use App\Exclusion;
use App\Repositories\Contracts\ExclusionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExclusionRepository implements ExclusionRepositoryInterface
{
    private $model;

    public function __construct(Exclusion $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return DB::table('exclusions')
            ->join('users', 'exclusions.id_user', '=', 'users.id')
            ->select('users.name', 'exclusions.*')
            ->get();

    }

    public function findById(int $id)
    {
        return $this->model::find($id);
    }

    public function create(array $exclusion)
    {
        $this->model->create($exclusion);
    }

    public function allByUser()
    {
        return DB::table('exclusions')
            ->where('exclusions.id_user', '=', Auth::id())
            ->join('users', 'exclusions.id_user', '=', 'users.id')
            ->select('users.name', 'exclusions.*')
            ->get();
    }
}
