<?php

namespace App\Http\Controllers\Api;

use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function index (string $order = 'level')
    {
        return response()->json($this->log->orderBy($order)->paginate(10), 200);
    }

    public function show (Log $id)
    {
        $data = ['data' => $id];
        return response()->json($data, 200);
    }

    public function create (Request $request)
    {
        try{
            $logData = $request->all();
            $this->log->create($logData);

            return response()->json(['message' => 'Log criado com sucesso!'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Não foi possível criar o log!'], 503);
        }

    }
}
