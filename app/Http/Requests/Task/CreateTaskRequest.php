<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'dead_line' => ['required', 'date'],
            'status' => ['required', 'string', 'in:ToDo,Doing,pendingApproval,Done'],
            'status_of_approval' => ['required'],
            'type_of_task' => ['required', 'string', 'max:255'],
            'note' => ['required', 'string'],
            'actual_date_of_closed' => ['nullable', 'date'],
            'stage_id' => ['required', 'integer', 'exists:project_stages,id'],
            'employee_assigned' => ['required', 'integer', 'exists:project_participants,id'],
            'supervisor_id' => ['required', 'integer', 'exists:project_participants,id'],
        ];
    }
}