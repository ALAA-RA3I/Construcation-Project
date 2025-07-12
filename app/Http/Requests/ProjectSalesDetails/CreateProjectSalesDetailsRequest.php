<?php

namespace App\Http\Requests\ProjectSalesDetails;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectSalesDetailsRequest extends FormRequest
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
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'main_title' => ['nullable', 'string', 'max:255'],
            'marketing_description' => ['nullable', 'string'],
            'location_link' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'video_url' => ['nullable', 'file', 'mimes:mp4,avi,mov,wmv,flv,webm', 'max:102400'], // 100MB max for videos
            'main_image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'], // 10MB max
            'diagram_image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif,webp,pdf', 'max:10240'], // 10MB max
        ];
    }
}
