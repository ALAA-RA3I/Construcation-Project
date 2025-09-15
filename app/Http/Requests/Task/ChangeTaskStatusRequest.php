<?php

namespace App\Http\Requests\Task;

use App\Domain\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(TaskStatusEnum::getValues())],
            'ticket_description' => ['nullable', 'string'],
        ];
    }
}
