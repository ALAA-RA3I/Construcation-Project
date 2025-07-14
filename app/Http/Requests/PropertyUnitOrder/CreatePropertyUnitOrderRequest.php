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
            'property_unit_id' => ['required', 'integer', 'exists:property_units,id'],
            
            'identity_file' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'],
            'clearance_certificate' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'],
            // 'status' => ['nullable', 'string', 'in:' . implode(',', PropertUnitOrderStatusEnum::getValues())],
            'note' => ['nullable', 'string'],
        ];
    }
}
