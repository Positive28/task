<?php

namespace App\Http\Requests\Citizen;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

            'full_name' => 'required|string',
            'passport' => 'required|string',
            'birth_date' => 'nullable|string',
            'company_id' => 'nullable|numeric',
            'start_date' => 'nullable|string',
            'end_date' => 'nullable|string',

            'page' => 'nullable|numeric',
            'per_page' => 'nullable|numeric'
        ];
    }
}
