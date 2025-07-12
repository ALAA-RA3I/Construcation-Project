<?php

namespace App\Http\Requests\PropertyBookBill;

use App\Domain\Enums\BookBillTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyBookBillRequest extends FormRequest
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
            'property_book_id' => ['required', 'integer', 'exists:property_books,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_in_months' => ['nullable', 'integer', 'min:0'],
            'type' => ['nullable', 'string', 'in:' . implode(',', BookBillTypeEnum::getValues())],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
