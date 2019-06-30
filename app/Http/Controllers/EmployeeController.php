<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee; 
use App\Employee;
use Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        $employee = new Employee();
        return $employee->createNewEmployee($reqest->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Employee int
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $this->authorize('view');
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Employee int
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, Employee $employee)
    {
        $emplyeeToUpdate = new Employee();
        return $emplyeeToUpdate->update($employee, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Employee int
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete');
        $employee->delete();
    }
}
