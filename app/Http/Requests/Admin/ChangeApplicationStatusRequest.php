<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangeApplicationStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'to_status' => ['required', 'string', 'max:100'],
            'note' => ['nullable', 'string', 'max:2000'],
            'public_visible' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'to_status.required' => __('Please select a status.'),
        ];
    }
}
