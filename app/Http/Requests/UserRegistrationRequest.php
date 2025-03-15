<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            "user_name"=>"required",
            "email"=>"required|email|unique:users,email",
            "password"=>"required",
            "phone_no"=>"required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10"
        ];
    }

    public function messages()
    {
        return[
            "user_name.required"=>"PLease Enter Your Name",
            "phone_no"=>"PLease Enter Your Mobile no",
            "email.unique"=>"Already have an account ON this Email"
        ];
    }

    public function attributes()
    {
        return[
            "password"=>"Password"
        ];
    }
}
