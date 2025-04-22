<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Budget;

class BudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = Auth::id();
        $budgetId = (int) $this->route('id');

        return [
            'amount' => 'required|numeric|min:0.01',
            'month_year' => [
                'required',
                'date_format:Y-m',
                function ($attribute, $value, $fail) use ($userId, $budgetId) {
                    $formattedMonth = substr($value, 0, 7) . '-01';

                    $query = Budget::where('user_id', $userId)
                        ->where('month_year', $formattedMonth);

                    if ($budgetId) {
                        $query->where('id', '!=', $budgetId);
                    }

                    if ($query->exists()) {
                        $fail('You already have a budget for this month.');
                    }
                },
            ],
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required'        => 'Budget amount is required.',
            'amount.numeric'         => 'The amount must be a number.',
            'amount.min'             => 'Amount must be greater than 0.',
            'month_year.required'    => 'Month and year is required.',
            'month_year.date_format' => 'The month must be in the format YYYY-MM.',
            'is_active.boolean'      => 'The active status must be true or false.',
        ];
    }
}
