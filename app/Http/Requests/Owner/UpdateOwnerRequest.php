<?php

namespace App\Http\Requests\Owner;

use App\Models\Engineer;
use App\Models\Owner;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $owner = Owner::find($this->route('id'));
        $userId = optional($owner?->user)->id;

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email,' . $userId,],

            'password'   => ['nullable', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'national_id' => ['required', 'unique:owners,national_id,' . $owner->id],
        ];
    }
}
