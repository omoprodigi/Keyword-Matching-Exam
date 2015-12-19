<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LecturerRequest extends Request
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
            'name' => 'required|min:3',
            'password' => 'required|min:8',
            'retype_password' => 'required|same:password',
            'email' => 'required|email',
            'department_id' => 'required|numeric|max:99',
        ];
    }
}
