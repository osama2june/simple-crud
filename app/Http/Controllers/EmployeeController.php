<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Service\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * @param Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Employee $employee)
    {
       $records  = $employee->with('company')->get();

        return view('employee.index',['employees' => $records] );
    }

    /**
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Company $company)
    {

        $id = 0 ;

        $employee = new EmployeeService();

        $response = $employee->getEmployee($id);

        $route = route('employee.store');

        $companies = $company->all();

        return view('employee.form',['employee' => $response,'companies' => $companies, 'route' => $route , 'edit' => false ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request , Employee $employee)
    {

        $request->validate([
            'name' => 'required', 'string' , 'min:3',
            'email' => 'required',
            'detail' => 'required',
            'company_id' => 'required',
        ]);

        $employeeInfo = new EmployeeService();
        $response = $employeeInfo->createEmployee( $employee , $request->toArray());

        return redirect()->route('employee.index')->with('success','Employee Add Successfully');

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
     * @param Company $company
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Company $company, $id)
    {
        $employee = new EmployeeService();

        $response = $employee->getEmployee($id);

        $route = route('employee.update', ['employee' => $id]);

        $companies = $company->all();

        return view('employee.form',['employee' => $response,'companies' => $companies, 'route' => $route , 'edit' => true ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request , Employee $employee)
    {
        $request->validate([
            'name' => 'required', 'string' , 'min:3',
            'detail' => 'required',
            'company_id' => 'required',
        ]);

        $employeeInfo = new EmployeeService();
        $response = $employeeInfo->updateEmployee( $employee , $request->toArray());

        return redirect()->route('employee.index')->with('success','Employee Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
