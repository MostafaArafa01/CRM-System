<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'company' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'vat' => 'required|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'address.required' => 'the address is required',
            'vat.required' => 'vat is required',
        ];
    }
}
