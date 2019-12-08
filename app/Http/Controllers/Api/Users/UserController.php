<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\Exclusions\ExclusionsController;
use App\Http\Requests\Request\UsersRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response()->json([
                'status' => 'OK',
                'data' => User::paginate(100)
            ]);
        }catch (\Throwable $e){
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json([
                'status' => 'OK',
                'data' => User::findOrFail($id)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        try{
            $credentials = $request->all(['name', 'password', 'email']);
            $user = User::where('id', $id)->first();
            $user->name = $credentials['name'];
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);
            if ($user->save()) {
                return response()->json([
                    'status' => 'OK',
                    'Message' => 'Update Successfully'], 201);
            }

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $user =  User::findOrFail($id);
            
            $exclusion = new ExclusionsController();
            $user = Auth::user();
            $data = [
                'value'=> json_encode($user),
                'id_user' => $user['id']
            ];

            $exclusion->create($data);

            $user->delete();
            return response()->json([
                'status' => 'OK',
                'Message' => "Deleted"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' =>$e
            ], 503);
        }

    }
}
