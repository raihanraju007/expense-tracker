<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a number.',
            'amount.min' => 'Amount must be at least 0.01.',
            'date.required' => 'Expense date is required.',
            'date.date' => 'Invalid date format.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Invalid category.',
        ];
    }
}
