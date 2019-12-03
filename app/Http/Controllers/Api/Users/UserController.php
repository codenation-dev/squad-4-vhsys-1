<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\Exclusions\ExclusionsController;
use App\Http\Requests\Request\UsersRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'data' => User::paginate(100)
        ]);
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
        return response()->json([
            'status' => 'OK',
            'data' => User::findOrFail($id)
        ]);
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
        return response()->json([
            'status' => 'ERROR',
            'Message' => 'Error Registering'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
    }
}
