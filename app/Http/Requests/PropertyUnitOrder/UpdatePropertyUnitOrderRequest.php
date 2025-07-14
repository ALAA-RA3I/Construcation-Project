<?php

namespace App\Http\Requests\PropertyUnitOrder;

use App\Domain\Enums\PropertUnitOrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyUnitOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'property_unit_id' => ['nullable', 'integer', 'exists:property_units,id'],
            // 'first_name' => ['nullable', 'string', 'max:255'],
            // 'middle_name' => ['nullable', 'string', 'max:255'],
            // 'last_name' => ['nullable', 'string', 'max:255'],
            // 'email' => ['nullable', 'email', 'max:255'],
            // 'phone' => ['nullable', 'string', 'max:255'],
            'identity_file' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'],
            'clearance_certificate' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'],
            // 'status' => ['nullable', 'string', 'in:' . implode(',', PropertUnitOrderStatusEnum::getValues())],
            'note' => ['nullable', 'string'],
        ];
    }
}
