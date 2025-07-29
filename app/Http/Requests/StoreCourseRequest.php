<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'modules' => 'required|array',
            'modules.*.title' => 'required|string',
            'modules.*.contents' => 'nullable|array',
            'modules.*.contents.*.title' => 'required|string',
            'modules.*.contents.*.type' => 'required|string|in:video,text,quiz',
            'modules.*.contents.*.video_url' => 'nullable|string',
            'modules.*.contents.*.video_length' => 'nullable|string',
        ];
    }
}
