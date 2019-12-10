<?php


namespace App\Repositories;


use App\Log;
use App\Repositories\Contracts\LogRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LogRepository implements LogRepositoryInterface
{
    private $model;

    public function __construct(Log $model)
    {
        $this->model = $model;
    }

    public function all() {
        return DB::table('logs')
            ->join('users', 'logs.user_created', '=', 'users.id')
            ->select('users.name', 'logs.*')
            ->get();

    }

    public function search($queryUrl) {
        $data = DB::table('logs')
                    ->select('logs.id', 'logs.level', 'logs.log', 'logs.events', 'logs.ambience', 'logs.status', 'logs.title', 'logs.created_at', 'users.name')
                    ->join('users', 'logs.user_created', '=', 'users.id');

        if(!empty($queryUrl['ambience'])){
            $data->where('ambience', '=', $queryUrl['ambience']);
        }

        if(!empty($queryUrl['search']) && !empty($queryUrl['search_name'])){
            $data = DB::table('logs')->where($queryUrl['search'], 'LIKE', $queryUrl['search_name']);
        }

        if(!empty($queryUrl['order'])){
            $data->orderBy($queryUrl['order']);
        }

        return $data->get();
    }

    public function findById(int $id){
        return $this->model::find($id);
    }

    public function create(array $log){
        $this->model->create($log);
    }

    public function toFile(Log $log) {
        $log->delete();
    }

    public function filled()
    {
        return $this->model->onlyTrashed()->with('User')->get();
    }

    public function forceDelete(Log $log) {
        $log->forceDelete();
    }
}
