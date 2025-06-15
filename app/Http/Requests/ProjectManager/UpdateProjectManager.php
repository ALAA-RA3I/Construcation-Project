<?php

namespace App\Http\Requests\ProjectManager;

use App\Models\ProjectManager;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectManager extends FormRequest
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
        $manager = ProjectManager::find($this->route('id'));
        $userId = optional($manager?->user)->id;
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email,' . $userId,],
            'password'   => ['nullable', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'max:20'],
            'bio' => ['nullable', 'string','max:500'],
            'years_of_experience' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
