<?php

namespace App\Http\Requests\TaskContainer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskContainerRequest extends FormRequest
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
            'quantity' => ['required', 'numeric', 'min:0'],
            'task_id' => ['required', 'integer', 'exists:tasks,id'],
            'items_id' => ['required', 'integer', 'exists:items,id'],
        ];
    }
}
