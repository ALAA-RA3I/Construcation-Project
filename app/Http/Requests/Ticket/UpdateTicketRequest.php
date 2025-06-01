<?php

namespace App\Http\Requests\Ticket;

use App\Domain\Enums\TicketStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTicketRequest extends FormRequest
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
            'description' => 'required|string',
            'status' => ['required', new Enum(TicketStatusEnum::class)],
            'task_id' => 'required|integer|exists:tasks,id',
        ];
    }
}