<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Employee;

class Employee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * set up the employee/company relationship
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
    public function createNewEmployee($request)
    {
        $newEmployee = $this->create([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'email'         => ($request->input('email')) ? $request->input('email') : null,
            'phone'         => ($request->input('phone')) ? $request->input('phone') : null,
            'company_id'    => $request->input('company_id'),
        ]);
        return $newEmployee;
    }

    /**
     * update a resource
     * 
     * @param first_name
     * @param last_name
     * @param email
     * @param phone
     * @param App\Employee as $employee
     * 
     */
    public function updateEmployee(Request $request, Employee $employee)
    {
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        ($request->input('email')) ? $employee->email = $request->input('email') : null;
        ($request->input('phone')) ? $employee->phone = $request->input('phone') : null;
        $employee->save();
        return $employee;
    }
}
