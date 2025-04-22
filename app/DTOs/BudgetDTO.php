<?php

namespace App\DTOs;

use App\Models\Budget;
use Carbon\Carbon;

class BudgetDTO
{
    public static function fromModel(Budget $budget): array
    {
        return [
            'id'         => $budget->id,
            'user_id'    => $budget->user_id,
            'amount'     => $budget->amount,
            'month_year' => Carbon::parse($budget->month_year)->format('Y-m'),
            'is_active'  => $budget->is_active,
            'created_by' => $budget->created_by,
            'created_at' => $budget->created_at,
            'updated_at' => $budget->updated_at,
        ];
    }

    public static function collection($budgets): array
    {
        return collect($budgets)->map(fn($budget) => self::fromModel($budget))->toArray();
    }
}
