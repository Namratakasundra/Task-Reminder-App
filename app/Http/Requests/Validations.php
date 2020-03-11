<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validations extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $messages = [
            'email.required' => 'Please enter valid email address!',
            'password.required' => 'How will you log in?',
            'password.confirmed' => 'Password is must be in 6 characters.',
        ];
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'
            ]
        ];
        return Validator::make($data, $rules, $messages);
    }
}
