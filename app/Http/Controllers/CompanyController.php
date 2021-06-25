<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\DeleteCompanyRequest;
use App\Http\Requests\Company\GetAllCompaniesRequest;
use App\Http\Requests\Company\GetCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @param GetAllCompaniesRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(GetAllCompaniesRequest $request)
    {
        $response = $request->handle();

        return view('company.index',['companies' => $response] );
    }

    /**
     * @param GetCompanyRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(GetCompanyRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $route = route('company.store');

        return view('company.form',['company' => $response, 'route' => $route, 'edit' => false ]);
    }

    /**
     * @param CreateCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $response = $request->handle();

        return redirect()->route('company.index')->with('success','Company Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $request = new GetCompanyRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('company.update', ['company' => $response->id]);

        return view('company.form',['company' => $response, 'route' => $route , 'edit' => true ]);
    }

    /**
     * @param UpdateCompanyRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('company.index')->with('success','Company Edit Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $request = new DeleteCompanyRequest();

        $request->id = $id;

        $response = $request->handle();

        return redirect()->route('company.index')->with('success','Company Delete Successfully');
    }
}
