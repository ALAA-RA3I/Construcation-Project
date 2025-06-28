<?php

namespace App\Http\Requests\ProjectContainer;

use Illuminate\Foundation\Http\FormRequest;

class CreateContainerRequset extends FormRequest
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
            'quantity-available' => 'required|numeric|min:0',
            'expected-quantity' => 'nullable|numeric|min:0',
            'consumed-quantity' => 'nullable|numeric|min:0',
            'required-quantity' => 'nullable|numeric|min:0',
            'remaining-quantity' => 'nullable|numeric|min:0',
        ];
    }
}
