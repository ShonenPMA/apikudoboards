<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
        $userAuthId = request()->user() ? request()->user()->id : 0;
        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,'. $userAuthId
            ],
            'birth_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:-18 years'
            ],
            'password' => [
                'string',
                'min:8',
                'confirmed',
                'regex:((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*\W)\w.{6,18}\w)'
            ],
            
        ];
    }

    public function messages()
    {
       return  [
           'password.regex' => 'The password must contain at least one number, one uppercase letter, one lowercase letter and one special character.',
           'birth_date.before' => 'You must be at least 18 years old'
        ];
    }
}
