<?php

namespace App\Http\Requests\Company;

use App\Company;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string' , 'min:3'],
            'email' => 'required', 'email' , 'unique:company',
            'detail' => ['required'],
        ];
    }
    public function handle()
    {

        $this->validated();

        $params = $this->all();

        $company = new Company();

        $company->name = $params['name'];
        $company->email = $params['email'];
        $company->detail = $params['detail'];
//        $company->start_date = date('Y-m-d H:i:s',strtotime($params['subp_start_date']));
//        $company->notify =isset($params['subsplan_notify']) ? 1  : 0;
        $company->save();

        return true;
    }
}
