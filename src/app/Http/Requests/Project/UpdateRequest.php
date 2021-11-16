<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userAuthId = request()->user() ? request()->user()->id : 0;
        $projectId = gettype($this->route('project')) == 'object' ? $this->route('project')->id : $this->route('project');
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('projects','name')->where(function($query) use($userAuthId){
                    return $query->where('user_id', $userAuthId);
                })->ignore($projectId)
            ]
        ];
    }
}
