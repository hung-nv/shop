<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdate extends FormRequest
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
            'name' => 'required|unique:articles,name, ' . $this->segment(3) . '|max:255',
            'slug' => 'required|unique:articles,slug, ' . $this->segment(3) . '|max:255',
            'image' => 'image|max:10240',
            'content' => 'required'
        ];
    }
}
