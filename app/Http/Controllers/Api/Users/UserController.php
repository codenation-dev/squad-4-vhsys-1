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
<<<<<<< HEAD

            $user =  User::findOrFail($id);
            
            $exclusion = new ExclusionsController();
            $user = Auth::user();
            $data = [
                'value'=> json_encode($user),
                'id_user' => $user['id']
            ];
=======
            $user = Auth::user();
            $data = [
                'value'=> json_encode($user),
                'id_user' => $user['id']
            ];

            $user =  User::where('id','=', $id)->first();

            $exclusion = new ExclusionsController();
>>>>>>> d63e72e20f18a18fec36df3da4ea44a3041838c3

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

<<<<<<< HEAD
=======
    }
    public function list_user_deleted(){
        try{
            return response()->json([
                'status' => 'OK',
                'Message' => User::onlyTrashed()->get()
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'Message' => 'Error not reported, consult administrator'
            ], 503);
        }
>>>>>>> d63e72e20f18a18fec36df3da4ea44a3041838c3
    }
}
