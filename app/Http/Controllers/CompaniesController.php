<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Barryvdh\Debugbar\Facades\Debugbar;

class CompaniesController extends Controller
{
    public function index()
    {

        $companies = Company::with('user')->paginate();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }


    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /* public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    } */

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect()->route('company.index');
    }

    public function destroy(Company $company)
    {
        //
    }
}
