<?php

namespace App\Http\Requests\PropertyBook;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyBookRequest extends FormRequest
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
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'model' => ['nullable', 'string', 'max:255'],
            'space' => ['nullable', 'integer'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'first_payment_amount' => ['nullable','numeric','min:0'],
            'description' => ['nullable', 'string'],
            'payment_period' => ['nullable', 'integer', 'min:1'],
            'available_units' => ['nullable','integer','min:0'],
            'number_of_rooms' => ['nullable', 'integer', 'min:0'],
            'number_of_bathrooms' => ['nullable', 'integer', 'min:0'],
            'direction' => ['nullable', 'string', 'max:255'],
            'diagram_image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'], // 10MB max
        ];
    }
}
