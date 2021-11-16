<?php

namespace App\Http\Requests\Team;

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
        $teamId = gettype($this->route('team')) == 'object' ? $this->route('team')->id : $this->route('team');
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('teams','name')->where(function($query) use($userAuthId){
                    return $query->where('user_id', $userAuthId);
                })->ignore($teamId)
            ]
        ];
    }
}
