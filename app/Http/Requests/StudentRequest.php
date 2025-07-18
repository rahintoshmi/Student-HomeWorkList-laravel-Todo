<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name' => 'required',
            'option' => 'required|in:CSE,BBA,English,Economics,Law,Agriculture,Pharmacy',
            'topic' => 'required',
        ];
    }

    function messages()
    {
        return [
            'name.required' => 'The student name is required.',
            'option.required' => 'Please select a department.',
            'topic.required' => 'The homework topic is required.',
        ];
    }
}
