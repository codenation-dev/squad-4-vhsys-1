<?php


namespace App\Services;


use App\Enums\AmbienceType;
use App\Enums\OrderByType;
use App\Enums\SearchByType;
use App\Repositories\Contracts\LogRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ExclusionServiceInterface;
use App\Services\Contracts\LogServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LogService implements LogServiceInterface
{
    private $logRepository;
    private $exclusionService;
    private $userRepository;

    public function __construct(
        LogRepositoryInterface $logRepository,
        ExclusionServiceInterface $exclusionService,
        UserRepositoryInterface $userRepository
    ) {
        $this->exclusionService = $exclusionService;
        $this->logRepository = $logRepository;
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        try {
            $logs = $this->logRepository->all();

            if ($this->userRepository->userAdmin() == 'user') {
                $logs = $this->logRepository->allLogUser();
            }

            return [
                'data' => $logs,
                'code' => 200
            ];
        } catch (\Exception $exception) {
            return [
                'data' => 'An error occurred while processing the request',
                'code' => 503
            ];
        }
    }

    public function search(array $queryUrl)
    {
        $validator = Validator::make($queryUrl, [
            'ambience' => Rule::in(AmbienceType::$types),
            'order' => Rule::in(OrderByType::$types),
            'search' => Rule::in(SearchByType::$types),

        ]);

        $validator = $validator->validate();

//        if (empty($validator)) {
//            return [
//                'data' => '',
//                'code' => 200
//            ];
//        }

        if (array_key_exists('errors', $validator)) {
            $data = $validator['message'];

            return [
                'data' => $data,
                'code' => 422
            ];
        }

        try {
            $logs = $this->logRepository->search($validator);

            return [
                'data' => $logs,
                'code' => 200
            ];
        } catch (QueryException $exception) {
            return [
                'data' => 'There was an error processing data',
                'code' => 503
            ];
        }

    }

    public function findById(int $id)
    {
        try {
            $log = $this->logRepository->findById($id);

            if (empty($log)) {
                return [
                    'data' => 'Not found log',
                    'code' => 404
                ];
            }

            return [
                'data' => $log,
                'code' => 200
            ];
        } catch (QueryException $exception) {
            return [
                'data' => 'An error occurred while processing the request',
                'code' => 503
            ];
        }
    }

    public function create($log)
    {
        $user = Auth::user();

        $log['user_created'] = $user['id'];

        try {
            $this->logRepository->create($log);

            return [
                'data' => 'Successfully created log',
                'code' => 201
            ];
        } catch (QueryException $exception) {
            return [
                'data' => 'Could not create log, an error occurred while processing data',
                'code' => 503
            ];
        }
    }

    public function toFile($id)
    {
        $log = $this->findById($id);

        if ($log['code'] == 404) {
            return $log;
        }

        try {
            $this->logRepository->toFile($log['data']);
        } catch (QueryException $exception) {
            return [
                'data' => 'Unable to archive file, processing occurred',
                'code' => 503
            ];
        }

        return [
            'data' => 'File successfully archived',
            'code' => 201
        ];
    }

    public function filled()
    {
        $data = $this->logRepository->filled();
        if ($this->userRepository->userAdmin() == 'user') {
            $data = $this->logRepository->filledUser();
        }

        return [
            'data' => $data,
            'code' => 200
        ];
    }

    public function destroy($id)
    {

        $log = $this->findById($id);


        if ($log['code'] == 404) {
            return $log;
        }

        $data = [
            'value' => json_encode($log),
            'id_user' => Auth::id(),
            'type' => 'Logs'
        ];

        $exclusion = $this->exclusionService->create($data);

        if ($exclusion['code'] == 503) {
            return $exclusion;
        }

        try {
            $this->logRepository->forceDelete($log['data']);

            return [
                'data' => 'Log deleted successfully',
                'code' => 200
            ];

        } catch (QueryException $exception) {
            return [
                'data' => 'Unable to delete log',
                'code' => 503
            ];
        }
    }
}
