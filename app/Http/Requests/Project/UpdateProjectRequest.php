<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'project_code' => ['required', 'string', 'max:255', Rule::unique('projects', 'project_code')->ignore($this->route('id'))],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'area' => ['required', 'integer'],
            'number_of_floor' => ['required', 'integer'],
            'status_of_sale' => ['required', 'string', 'in:ForSale,NotForSale'],
            'expected_date_of_completed' => ['required', 'date'],
            'type' => ['required', 'string', 'in:Commercial,Residential'],
            'progress_status' => ['required', 'string', 'in:Initial,InProgress,Done'],
            'expected_cost' => ['required', 'integer'],
            'owner_id' => ['required', 'integer', 'exists:owners,id'],
            'consulting_company_id' => ['required', 'integer', 'exists:consulting_companies,id'],
        ];
    }
}