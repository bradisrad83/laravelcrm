<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee; 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', 'App\User');
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreEmployee  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        $user = new User();
        return $user->createNewUser($request->validated());

    }

    /**
     * Display the specified resource.
     *
     * @param  App\User int
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateEmployee  $request
     * @param  App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, User $user)
    {
        $userToUpdate = new User();
        return $userToUpdate->updateUser($user, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delte', $user);
        $user->delete();
    }
}
