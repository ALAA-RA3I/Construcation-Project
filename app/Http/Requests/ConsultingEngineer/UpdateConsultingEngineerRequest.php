<?php

namespace App\Http\Requests\ConsultingEngineer;

use App\Models\ConsultingEngineer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultingEngineerRequest extends FormRequest
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
        $engineer = ConsultingEngineer::find($this->route('id'));
        $userId = optional($engineer?->user)->id;
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email,' . $userId,],
            'password'   => ['nullable', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'max:20'],
            'engineer_specialization_id' => ['required', 'exists:engineer_specializations,id'],
            'consulting_company_id' => ['required', 'exists:consulting_engineers,id'],
        ];
    }
}
