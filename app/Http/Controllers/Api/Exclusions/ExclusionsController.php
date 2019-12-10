<?php

namespace App\Http\Controllers\Api\Exclusions;

use App\Exclusion;
use App\Http\Requests\ExclusionsRequest;
use App\Services\Contracts\ExclusionServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExclusionsController extends Controller
{
    private $exclusionService;

    public function __construct(ExclusionServiceInterface $exclusionService)
    {
        $this->exclusionService = $exclusionService;
    }

    public function index()
    {
        $data = $this->exclusionService->all();

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }

    public function create($request)
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

    public function show($id)
    {
        $data = $this->logService->findById($id);

        return response()->json(
            [
                'data' => $data['data']
            ],

            $data['code']
        );
    }
}
