<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany; 
use Illuminate\Support\Facades\Storage;
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
    public function store(StoreCompany $request)
    {
        $company = new Company();
        return $company->createNewCompany($request->validated());
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
        return $company;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, Company $company)
    {
        $this->authorize('update', $company);
        $companyToUpdate = new Company();
        return $companyToUpdate->updateCompanyDetails($company, $request->validated());
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
    }
}
