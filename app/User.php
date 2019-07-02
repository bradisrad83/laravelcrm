<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Employee;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Always attaches the roles when user(s)
     * are returned
     */
    public $with = ['role'];

    /**
     * set up the user/role relationship
     *
     * @return Role::class
     */
    public function role() 
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * checks a role
     * 
     * @param string $role
     * 
     * @return
     */
    public function hasRole(string $role)
    {
        return null !== $this->role()->Where('name', $role)->first();
    }

    /**
     * Checks if the user is an
     * admin role
     * 
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Checks if the user is an
     * manager role
     * 
     * @return boolean
     */
    public function isManager()
    {
        return $this->hasRole('manager');
    }

    /**
     * set up relationships between
     * company and user
     * 
     * @return Company::class
     */
    public function company() 
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * create a resource
     * 
     * @param first_name
     * @param last_name
     * @param email
     * @param phone
     * 
     * @return App\Employee (resource)
     */
    public function createNewUser($request)
    {
        $newUser = $this->create([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'password'      => bcrypt($request->input('password')),
            'role_id'       => $request->input('role'),
            'company_id'    => ($request->input('company_id')) ? $request->input('company_id') : null
        ]);
        return $newUser;
    }

    /**
     * create a resource
     * 
     * @param App\User int
     * @param first_name
     * @param last_name
     * @param email
     * @param phone
     * 
     * @return App\Employee (resource)
     */
    public function updateUser(User $user, Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        ($request->password) ?  $user->password = bcrypt($request->input('password')) : null;
        $user->role_id = $request->input('role');
        (!$request->company_id) ? $user->company_id = $request->input('company_id') : null;
        $user->save();
        return $user;
    }
}
