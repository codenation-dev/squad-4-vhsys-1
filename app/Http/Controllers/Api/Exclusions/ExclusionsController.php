<?php

namespace App\Http\Controllers\Api\Exclusions;

use App\Exclusion;
use App\Http\Requests\ExclusionsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExclusionsController extends Controller
{
    public function create($request){

        if(Exclusion::create($request)){
            return true;
        }

    }
    public function show(){
        return response()->json([
            'message' => Exclusion::paginate(10),
            'status' => 'ok',
        ], 200);
    }
}
