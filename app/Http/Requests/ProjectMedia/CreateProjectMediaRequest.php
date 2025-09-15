<?php

namespace App\Http\Requests\ProjectMedia;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectMediaRequest extends FormRequest
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
            'path_file' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx,txt,mp4,avi,mov,wmv,flv,webm', 'max:102400'], // 100MB max
        ];
    }
}
