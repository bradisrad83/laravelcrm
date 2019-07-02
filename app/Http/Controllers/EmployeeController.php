<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
        ]);
        $employee = new Employee();
        $employee->createNewEmployee($request);
        return redirect('/companies'.'/'.$request->company_id);
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
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
        ]);
        $employeeToUpdate = new Employee();
        $employeeToUpdate->updateEmployee($request, $employee);
        return redirect('/companies'.'/'.$employee->company_id);
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
