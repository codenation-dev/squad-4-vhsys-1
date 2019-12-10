<?php


namespace App\Services;


use App\Repositories\Contracts\ExclusionRepositoryInterface;
use App\Services\Contracts\ExclusionServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ExclusionService implements ExclusionServiceInterface
{
    private $exclusionRepository;

    public function __construct(ExclusionRepositoryInterface $exclusionRepository)
    {
        $this->exclusionRepository = $exclusionRepository;
    }

    public function all() {
        try{
            $exclusion = $this->exclusionRepository->all();

            return [
                'data' => $exclusion,
                'code' => 200
            ];
        }catch (QueryException $exception) {
            return [
                'data' => 'An error occured while processing the request',
                'code' => 503
            ];
        }
    }

    public function findById(int $id)
    {
        try{
            $exclusion = $this->exclusionRepository->findById($id);

            return [
                'data' => $exclusion,
                'code' => 200
            ];
        }catch (ModelNotFoundException $exception){
            return [
                'data' => 'Not found exclusion',
                'code' => 404
            ];
        }
    }

    public function create($exclusion)
    {
        $user = Auth::user();

        $exclusion['id_user'] = $user['id'];

        try{
            $this->exclusionRepository->create($exclusion);

            return [
                'data' => 'Successfully created exclusion',
                'code' => 201
            ];
        }catch (QueryException $exception){
            return [
                'data' => 'Could not create exclusion, an error occurred while processing data',
                'code' => 503
            ];
        }
    }
}
