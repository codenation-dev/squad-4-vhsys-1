<?php

namespace App\Http\Controllers\Api\Exclusions;

use App\Exclusion;
use App\Http\Requests\ExclusionsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExclusionsController extends Controller
{
    public function create($request){

        if(Exclusion::create($request)){
            return true;
        }

    }
    public function show(){

        $teste =  DB::table('exclusions')
            ->join('users', 'exclusions.id_user', '=', 'users.id')
            ->select('users.name', 'exclusions.*')
            ->get();

        return response()->json([
            'data' => $teste,
            'status' => 'ok',
        ], 200);
    }
}
