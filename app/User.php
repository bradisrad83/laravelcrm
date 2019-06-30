<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'name', 'email', 'password',
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
}
