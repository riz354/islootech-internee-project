<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthenticateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            "email"=>"required|email",
            "password"=>"required"
        ];
    }

    public function messages()
    {
        return[
            "email.required"=>"PLease Enter Your Name",
            "password.required"=>"PLease Enter Your Password",
            "password"=>"PLease Enter  Correct password",

        ];
    }

    public function attributes()
    {
        return[
            "password"=>"Password"
        ];
    }
}
