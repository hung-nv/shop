<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisingUpdate extends FormRequest
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
            'name' => 'required|unique:advertising,name, ' . $this->segment(3) . '|max:255',
            'type' => 'required'
        ];

        if ($this->type == 1) {
            $rules['script'] = 'required';
        } elseif ($this->type == 2) {
            if (!empty($this->old_image)) {
                $rules['image'] = 'image|max:1024';
            } else {
                $rules['image'] = 'required|image|max:1024';
            }
        }

        return $rules;
    }
}
