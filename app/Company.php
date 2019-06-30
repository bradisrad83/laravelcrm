<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * set up the company/employee relationship
     *
     * @return Role::class
     */
    public function employees() 
    {
        return $this->hasMany('App\Employee');
    }
}
