<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'first_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
        ];
    }
    public function messages() {
        return [
            'first_name.required' => 'Please Enter First Name.',
            'last_name.required' => 'Please Enter Last Name.',
            'email.required' => 'Please Enter Email.',
            'email.unique' => 'Email Already Registered.',
            'email.email' => 'Please Enter Valid Email.',
            'user_role.required' => 'Please Select User Role.',
        ];
    
}
}
