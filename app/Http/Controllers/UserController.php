<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Role;
use App\Company;
use Auth;

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
        return view('users.allusers')->with('allUsers', User::with('company')->get())->with('user', Auth::user())->with('roles', Role::all())->with('companies', Company::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreEmployee  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', 'App\User');
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
        ]);
        $user = new User();
        $user->createNewUser($request);
        return redirect('/users');

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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
        ]);
        $userToUpdate = new User();
        $userToUpdate->updateUser($user, $request);
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect('/users');
    }
}
