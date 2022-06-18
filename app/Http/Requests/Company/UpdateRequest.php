<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'sort_key' => 'nullable',
            'sort_type' => 'required_with:sort_key',

            'company_name' => 'nullable|string',

            'page' => 'nullable|numeric',
            'per_page' => 'nullable|numeric'
        ];
    }
}
