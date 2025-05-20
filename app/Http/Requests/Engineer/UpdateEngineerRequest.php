<?php

namespace App\Http\Requests\Engineer;

use App\Models\Engineer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEngineerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $engineer = Engineer::find($this->route('id'));
        $userId = optional($engineer?->user)->id;
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email,' . $userId,],
            'password'   => ['nullable', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'max:20'],
            'engineer_specialization_id' => ['required', 'exists:engineer_specializations,id'],
            'years_of_experience' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
