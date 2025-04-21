<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255|unique:categories,name',
                'slug' => 'required|string|max:255|unique:categories,slug',
                'description' => 'nullable|string',
                'is_active' => 'nullable|boolean',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('categories', 'name')->ignore($this->id),
                ],
                'slug' => [
                    'required', 'string', 'max:255',
                    Rule::unique('categories', 'slug')->ignore($this->id),
                ],
                'description' => 'nullable|string',
                'is_active' => 'nullable|boolean',
            ];
        }

        return [];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'name.unique'   => 'This category name is already taken.',
            'slug.required' => 'Slug is required.',
            'slug.unique'   => 'This slug is already taken.',
        ];
    }
}

