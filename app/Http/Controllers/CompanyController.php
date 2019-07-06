<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Company;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', 'App\Company');
        return view('companies.allcompanies')->with('companies', Company::all())->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', 'App\Company');
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
        ]);
        $company = new Company();
        $company->createNewCompany($request);
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $this->authorize('view', $company);
        return view('companies.company')->with('user', Auth::user())->with('company', $company->load('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
        ]);
        $companyToUpdate = new Company();
        $companyToUpdate->updateCompanyDetails($company, $request);
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        $company->delete();
        return redirect('/companies');
    }
}
