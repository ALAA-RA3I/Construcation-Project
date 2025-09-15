<?php

namespace App\Http\Requests\RealStateManager;

use App\Models\RealStateManager;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRealStateManagerRequest extends FormRequest
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
        $realStateManager = RealStateManager::find($this->route('id'));
        $userId = optional($realStateManager?->user)->id;
        
        return [
           'first_name' => ['required','max:255','string'],
           'last_name' => ['required','max:255','string'],
           'email' => ['required','email','unique:users,email,' . $userId,],
           'password' => ['required','string','min:8'],
           'phone_number' => ['required','string','max:20'],
        ];
    }
}
