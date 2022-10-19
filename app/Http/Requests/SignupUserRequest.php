<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;

class SignupUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'address' => 'required',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
        ];
    }
}
