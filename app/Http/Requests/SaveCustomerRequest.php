<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCustomerRequest extends FormRequest
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
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'email|required|unique:customers,email'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Vui lòng nhập đúng định dạng email'
        ];
    }
}
