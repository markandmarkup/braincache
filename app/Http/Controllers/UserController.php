<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResourceCollection
     */
    public function index() : UserResourceCollection
    {
        return new UserResourceCollection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request) : UserResource
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'role'      => 'required',
        ]);

        $user = User::create($request->all());

        return new UserResource($user);
    }

    /**
     * Return the specified resource.
     *
     * @param  User  $user  // Id of the user to be updated
     * @return UserResource
     */
    public function show(User $user) : UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user   // Id of the user to be updated
     * @return UserResource
     */
    public function update(Request $request, User $user) : UserResource
    {
        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user   // Id of the user to be updated
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json();
    }
}
