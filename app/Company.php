<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
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
     * set up the user/company relationship
     * 
     * @return User::class
     */
    public function users()
    {
        return $this->hasMany('App\User');
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
    public function createNewCompany($request)
    {
        $newCompany = $this->create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'website'   => ($request->website) ? $request->input('website') : null,
        ]);   
        if($request->input('logo')) 
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
        $file = Input::file('logo');
        Log::debug($file);
        Log::debug($file->getClientOriginalExtension());
        $fileName = $newCompany->name.".".$file->getClientOriginalExtension();
        $newCompany->update(['logo' => Storage::put('logos', $file, 'public')]);
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
        Log::debug($request->input('logo'));
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        if($request->input('website'))
            $company->website = $request->input('website');
        $company->save();
        if($request->logo)  {
            Log::debug('there is a logo');
            Storage::delete($company->logo);
            return $this->storeCompanyLogo($company, $request);
        }
        return $company;
    }
}
