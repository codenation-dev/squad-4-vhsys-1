<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Exclusions\ExclusionsController;
use App\Http\Requests\logRequest;
use App\Log;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\JWTAuth;

class LogController extends Controller
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function index($order = 'level')
    {
        try {
            $teste = DB::table('logs')
                ->join('users', 'logs.user_created', '=', 'users.id')
                ->select('users.name','user.admin', 'logs.*')
                ->orderBy($order)
                ->paginate(10);

            return response()->json($teste, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }

    }

    public function show(Log $id)
    {
        try {
            $data = ['data' => $id];
            return response()->json($data, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }

    }

    public function create(logRequest $request)
    {
        $request->validated();
        $user = Auth::user();

        try {
            $logData = $request->all();
            $logData['user_created'] = $user['id'];


            $this->log->create($logData);

            return response()->json([
                'message' => 'Successfully created log!',
                'status' => 'OK',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
    }

    public function tofile($id)
    {
        try {
            if ($log = Log::find($id)) {
                $log->delete();
                return response()->json([
                    'message' => 'Success in archiving the log!',
                    'status' => 'OK',
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Error locating log to archive!',
                    'status' => 'ERRO',
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
    }
    public function filled(){
        try{
            return response()->json([
                'status' => 'OK',
                'Message' => Log::onlyTrashed()->get()
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
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
                    'id_user' => $user['id'],
                    'type' => 'Log'
                ];

                $exclusion->create($data);

                $log->forceDelete();
                return response()->json([
                    'message' => 'Success in deleting log!',
                    'status' => 'OK',
                ], 201);
            } else {
                return response()->json([
                    'message' => 'log not found !',
                    'status' => 'ERRO',
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
    }

    public function search(Request $request)
    {

        $form = $request->all();
        $data = Log::where(function ($query) use ($form){
            if(isset($form['search'])){
                $query->where($form['search'], 'LIKE','%'.$form['search_name'].'%')
                    ->join('users', 'logs.user_created', '=', 'users.id')
                    ->select('users.name','user.admin','logs.*');
            }
            if(isset($form['ambience'])){
                $query->with('User')
                    ->where('ambience', '=', $form['ambience']);

            }
            if(isset($form['order'])){
                $query->orderBy($form['order'])
                    ->join('users', 'logs.user_created', '=', 'users.id')
                    ->select('users.name','user.admin','logs.*');;
            }
        })->get();

//        exemplo de busca de usuario
//        $data = Log::with('User')->get();


        return response()->json($data);
    }


}
