<?php

namespace App\Http\Requests\Stripe;

use Illuminate\Foundation\Http\FormRequest;

class StripeFormRequest extends FormRequest
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
            'card_number' => ['required','integer','digits_between:13,19'],
            'exp_month' => ['required','integer','between:1,12'],
            'exp_year' => ['required','integer', 'min:'. date('Y')],
            'cvc' => ['required','digits_between:3,4'],
            'stripe_token' => ['required','string']
        ];
    }
}
