<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisingStore extends FormRequest
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
        $rules = [
            'name' => 'required|unique:advertising,name|max:255',
            'type' => 'required'
        ];

        if ($this->type == 1) {
            $rules['script'] = 'required';
        } elseif ($this->type == 2) {
            $rules['image'] = 'required|image|max:1024';
        }

        return $rules;
    }
}
