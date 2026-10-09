<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => ['nullable', 'exists:services,id'],
            'slug' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:50'],
            'title_bn' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'summary_bn' => ['nullable', 'string'],
            'summary_en' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'duration_days' => ['nullable', 'integer', 'min:1', 'max:365'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:10'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'countries' => ['nullable', 'array'],
            'countries.*' => ['exists:countries,id'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery' => ['nullable', 'array', 'max:20'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_bn.required' => __('Bangla title is required.'),
            'base_price.required' => __('Base price is required.'),
        ];
    }
}
