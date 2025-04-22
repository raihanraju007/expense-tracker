<?php

namespace App\DTOs;

use App\Models\Expense;

class ExpenseDTO
{
    public static function fromModel(Expense $expense): array
    {
        return [
            'id'            => $expense->id,
            'amount'        => $expense->amount,
            'description'   => $expense->description,
            'date'          => $expense->date,
            'category_id'   => $expense->category_id,
            'user_id'       => $expense->user_id,
            'created_by'    => $expense->created_by,
            'created_at'    => $expense->created_at,
            'updated_at'    => $expense->updated_at,
        ];
    }

    public static function collection($expenses): array
    {
        return collect($expenses)->map(fn($e) => self::fromModel($e))->toArray();
    }
}
