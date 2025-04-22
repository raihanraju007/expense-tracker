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
    
        $id = $this->route('id') ?? $this->route('category')?->id ?? $this->id;

        $rules = [
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];

        if ($this->isMethod('post')) {
            $rules['name'] = 'required|string|max:255|unique:categories,name';
            $rules['slug'] = 'required|string|max:255|unique:categories,slug';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $nameRules = ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($id)];
            $slugRules = ['required', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($id)];

            if ($this->isMethod('patch')) {
                array_unshift($nameRules, 'sometimes');
                array_unshift($slugRules, 'sometimes');
            }

            $rules['name'] = $nameRules;
            $rules['slug'] = $slugRules;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'name.unique' => 'This category name is already taken.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug is already taken.',
        ];
    }
}
