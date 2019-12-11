<?php


namespace App\Services;


use App\Enums\AmbienceType;
use App\Enums\OrderByType;
use App\Enums\SearchByType;
use App\Repositories\Contracts\LogRepositoryInterface;
use App\Services\Contracts\LogServiceInterface;
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
            return [];
        }

        if(array_key_exists('errors', $validator)){
            return $validator['message'];
        }

        return $this->logRepository->search($validator);
    }

    public function findById(int $id) {
        return $this->logRepository->find($id);
    }
}
