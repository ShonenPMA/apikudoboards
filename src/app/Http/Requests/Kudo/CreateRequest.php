<?php

namespace App\Http\Requests\Kudo;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'description' => [
                'required',
                'string'
            ],
            'kudoboard_id' => [
                'required',
                'integer',
                'exists:kudoboards,id'
            ],
            'user_receiver_id' => [
                'required',
                'integer',
                'exists:users,id'
            ]
        ];
    }
}
