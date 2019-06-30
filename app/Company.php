<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Company;


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

    /**
     * create a resource
     * 
     * @param name
     * @param email
     * @param website
     * @param logo
     * 
     * @return App\Company (resource)
     */
    public function createNewCompany(Request $request)
    {
        $newCompany = $this->create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'website'   => ($request->website) ? $request->input('website') : null,
        ]);   
        if($request->logo) 
            return $this->storeCompanyLogo($newCompany, $request);
        return $newCompany;
    }

    /**
     * store the logo of the company
     * in storage and reference that location
     * into the Company resource in the DB
     * 
     * @param App\Company as $newCompany
     * @param request
     * 
     * @return App\Company
     */
    public function storeCompanyLogo(Company $newCompany, $request)
    {
        $fileName = $newCompany->name.'logo.jpg';
        $newCompany->update(['logo' => Storage::putFile($fileName, $request->file('logo'))]);
        return $newCompany;
    }

    /**
     * update a resource
     * 
     * @param App\Company
     * @param name
     * @param email
     * @param website
     * @param logo
     * 
     * @return App\Company
     */
    public function updateCompanyDetails(Company $company, Request $request)
    {
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        if($request->input('webstie'))
            $company->webstie = $request->input('webstie');
        $company->save();
        if($request->input('logo'))  {
            Storage::delete($company->logo);
            return $this->storeCompanyLogo($company, $request);
        }
        return $company;
    }
}
