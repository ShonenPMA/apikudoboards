<?php

namespace App\Http\Requests\TeamUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'team_id' => [
                'required',
                'integer',
                'exists:teams,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('team_users','user_id')->where(function($query){
                    return $query->where('team_id', $this->input('team_id'));
                })
            ]
        ];
    }

    public function messages()
    {
        return [
            'user_id.unique' => 'This user have already been registered in this team.'
        ];
    }
}
