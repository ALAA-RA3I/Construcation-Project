<?php

namespace App\Http\Requests\PropertyUnitOrder;

use App\Domain\Enums\PropertUnitOrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyUnitOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'property_book_id' => ['required', 'integer', 'exists:property_books,id'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'identity_file' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'],
            'note' => ['nullable', 'string'],
        ];
    }
}
