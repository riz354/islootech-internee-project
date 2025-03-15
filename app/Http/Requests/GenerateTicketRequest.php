<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateTicketRequest extends FormRequest
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
            "title"=>"required",
            'message'=>"required",
            'label_checkbox'=>'required',
            'category_checkbox'=>'required',
            'priority'=>'required',
            // "image"=>"required|mimes:png,jpg,jpeg|max:5048 ",

        ];
    }


}
