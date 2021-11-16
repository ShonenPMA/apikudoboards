<?php

namespace App\Http\Requests\ProjectUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
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
            'project_id' => [
                'required',
                'integer',
                'exists:projects,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('project_users','user_id')->where(function($query){
                    return $query->where('project_id', $this->input('project_id'));
                })
            ]
        ];
    }

    public function messages()
    {
        return [
            'user_id.unique' => 'This user have already been registered in this project.'
        ];
    }
}
