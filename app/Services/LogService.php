<?php


namespace App\Services;


use App\Enums\AmbienceType;
use App\Enums\OrderByType;
use App\Enums\SearchByType;
use App\Repositories\Contracts\LogRepositoryInterface;
use App\Services\Contracts\LogServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LogService implements LogServiceInterface
{
    private $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function search(array $queryUrl)
    {
        $validator = Validator::make($queryUrl, [
            'ambience' => Rule::in(AmbienceType::$types),
            'order'  => Rule::in(OrderByType::$types),
            'search' => Rule::in(SearchByType::$types)
        ]);

        $validator = $validator->validate();

        if(empty($validator)){
            $data = ['data' => ''];
            return ['data' => $data, 'code' => 200];
        }

        if(array_key_exists('errors', $validator)){
            $data = ['data' => $validator['message']];
            return ['data' => $data, 'code' => 422];
        }

        try{
            $logs = $this->logRepository->search($validator);
        }catch (QueryException $exception){
            $data = ['data' => 'There was an error processing data'];
            return ['data' => $data, 'code' => 503];
        }

        $data = ['data' => $logs];
        return ['data' => $data, 'code' => 200];
    }

    public function findById(int $id) {
        try{
            $log = $this->logRepository->find($id);
        }catch (ModelNotFoundException $exception){
            $data = ['data' => 'Not found log'];
            return ['data' => $data, 'code' => 400];
        }

        $data = ['data' => $log];
        return ['data' => $data, 'code' => 200];
    }

    public function create($log) {
        $user = Auth::user();

        $log['user_created'] = $user['id'];

        try{
            $this->logRepository->create($log);
        }catch (QueryException $exception){
            $data = ['data' => 'Could not create log, an error occurred while processing data'];
            return ['data' => $data, 'code' => 503];
        }

        $data = ['data' => 'Successfully created log'];
        return ['data' => $data, 'code' => 201];
    }
}
