<?php

namespace App\Http\Requests\PropertyUnit;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyUnitRequest extends FormRequest
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
            'property_book_id' => ['nullable', 'integer', 'exists:property_books,id'],
            'unit_number' => ['nullable', 'integer'],
            'floor' => ['nullable', 'integer'],
            // 'client_id' => ['nullable', 'integer'],
        ];
    }
}
