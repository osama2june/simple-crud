<?php


namespace App\Service;


use App\Employee;

class EmployeeService
{
    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEmployee(int $id)
    {
        return Employee::with('company')->findOrNew($id);
    }

    public function createEmployee(Employee $emploee, array $request): Employee
    {
        $emploee->name = $request['name'];
        $emploee->email = $request['email'];
        $emploee->detail = $request['detail'];
        $emploee->company_id = $request['company_id'];

        $emploee->save();

        return $emploee;
    }

    /**
     * @param Employee $emploee
     * @param array $request
     * @return Employee
     */
    public function updateEmployee(Employee $emploee, array $request): Employee
    {
        $emploee->name = $request['name'];
//        $emploee->email = $request['email'];
        $emploee->detail = $request['detail'];
        $emploee->company_id = $request['company_id'];

        $emploee->save();

        return $emploee;
    }
}
