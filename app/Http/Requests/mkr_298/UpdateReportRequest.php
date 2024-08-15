<?php

namespace App\Http\Requests\mkr_298;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,webp|max:1024',
            'year_id' => 'nullable|numeric|exists:years,id',
            'month_id' => 'nullable|numeric|exists:months,id'
        ];
    }
}
