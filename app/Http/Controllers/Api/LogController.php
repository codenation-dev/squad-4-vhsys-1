<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Exclusions\ExclusionsController;
use App\Http\Requests\logRequest;
use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;

class LogController extends Controller
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function index (string $order = 'level')
    {
        $teste =  DB::table('logs')
            ->join('users', 'logs.user_created', '=', 'users.id')
            ->select('users.name', 'logs.*')
            ->orderBy($order)
            ->paginate(10);

        return response()->json($teste, 200);
    }

    public function show (Log $id)
    {
        $data = ['data' => $id];
        return response()->json($data, 200);
    }

    public function create (logRequest $request)
    {
        $request->validated();
        $user = Auth::user();

        try{

            $logData = $request->all();
            $logData['user_created'] = $user['id'];


           $this->log->create($logData);

            return response()->json([
                'message' => 'Log criado com sucesso!',
                'status' => 'OK',
            ], 201);

        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Não foi possível criar o log!',
                'status' => 'ERRO',
            ], 503);
        }
    }

    public function tofile($id)
    {
        try {
            if ($log = Log::find($id)) {
                $log->delete();
                return response()->json([
                    'message' => 'Sucesso ao arquivar Log!',
                    'status' => 'OK',
                ], 503);
            } else {
                return response()->json([
                    'message' => 'Erro ao localizar log para arquivar!',
                    'status' => 'ERRO',
                ], 503);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao arquivar o log!',
                'status' => 'ERRO',
            ], 503);
        }
    }

    public function destroy($id)
    {
        try {
            if ($log = Log::find($id)) {
                $exclusion = new ExclusionsController();
                $user = Auth::user();
                $data = [
                    'value' => json_encode($log),
                    'id_user' => $user['id']
                ];

                $exclusion->create($data);

                $log->forceDelete();
                return response()->json([
                    'message' => 'Sucesso ao deletar o  Log!',
                    'status' => 'OK',
                ], 503);
            } else {
                return response()->json([
                    'message' => 'Erro ao deletar o log !',
                    'status' => 'ERRO',
                ], 503);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar o log!',
                'status' => 'ERRO',
            ], 503);
        }
    }

    public function search(Request $request)
    {


        $data = Log::all();
        if (array_key_exists('select', ($request->all()))) {
            $select = explode(',',$request['select']);

            $data =  DB::table('logs')
                ->join('users', 'logs.user_created', '=', 'users.id')
                ->select('users.name', 'logs.' . $select)
                ->get();

        }
        if (array_key_exists('search', ($request->all()))) {
            $data =  DB::table('logs')->where($request['search'],'LIKE',$request['search_name'])->get();
        }

        if (array_key_exists('ambience', ($request->all()))) {
            $data =  DB::table('logs')->where ('ambience','=',$request['ambience'])->get();

        }
        if (array_key_exists('order', ($request->all()))) {
            $data =  DB::table('logs')->orderBy ($request['order'])->get();
        }
//        e
//        lse{
//            $data =  DB::table('logs')
//                ->where($request['search'],'LIKE',$request['search_name'])
//                ->orWhere ('ambience','=',$request['ambience'])
//                ->orderBy ($request['order'])->get();
//        }

        return response()->json($data);
    }


}
