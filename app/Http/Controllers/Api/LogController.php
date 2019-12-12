<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Exclusions\ExclusionsController;
use App\Http\Requests\logRequest;
use App\Log;
use App\Services\Contracts\LogServiceInterface;
use App\Services\LogService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\JWTAuth;

class LogController extends Controller
{
    private $logService;

    public function __construct(LogServiceInterface $logService)
    {
        $this->logService = $logService;
    }

    public function index()
    {
        $data = $this->logService->all();

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function search(Request $request)
    {
        $queryUrl = $request->query();
        $data = $this->logService->search($queryUrl);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']);
    }

    public function show(int $id)
    {
        $data = $this->logService->findById($id);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']);
    }

    public function create(logRequest $request)
    {
        $request->validated();

        $data = $this->logService->create($request->all());

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function toFile($id)
    {
        $data = $this->logService->toFile($id);
        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']);
    }

    public function filled(){
        $data = $this->logService->filled();
        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function destroy($id)
    {
        $data = $this->logService->destroy($id);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }
}
