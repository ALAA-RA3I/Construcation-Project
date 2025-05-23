<?php

namespace App\Http\Requests\ConsultingCompany;

use Illuminate\Foundation\Http\FormRequest;

class CreateConsultingCompanyRequest extends FormRequest
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
            'name' => ['required','string','max:255','unique:consulting_companies,name'],
            'email'=> ['required','email','unique:consulting_companies,email'],
            'focal_point_first_name' => ['required','string','max:255'],
            'focal_point_last_name' => ['required','string','max:255'],
            'address' => ['required','string','max:255'],
            'phone_number' => ['required','string','max:20'],
            'land_line' => ['required','string','max:20'],
            'license_number' => ['required','string','unique:consulting_companies,license_number'],
        ];
    }
}
