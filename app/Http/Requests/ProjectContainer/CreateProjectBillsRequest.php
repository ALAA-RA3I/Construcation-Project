<?php

namespace App\Http\Requests\ProjectContainer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProjectBillsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'nullable|string',
            'date_of_payment' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'details' => 'required|array|min:1',
            'details.*.item' => 'required|string',
            'details.*.note' => 'nullable|string',
            'details.*.cost' => 'required|numeric|min:0',
        ];
    }
}
