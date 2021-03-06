<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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

            //filter
            /*
                'filter' => [
                    [
                        'key' => 'id'
                        'type' => 'equal' {equal, like, in, between, greater}
                        'value' => 12
                    ]
                ]
            */

            'name' => 'nullable|string',
            'username' => 'nullable|string',
            'status' => 'nullable|numeric',

            //paginate
            /*
                'pagination' => [
                    'page' => 1,
                    'per_page' => 10
                ]
            */

            'page' => 'nullable|numeric',
            'per_page' => 'nullable|numeric'
        ];
    }
}
