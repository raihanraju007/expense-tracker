<?php

namespace App\Repositories;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseRepository
{
    public function all()
    {
        return Expense::where('user_id', Auth::id())->latest()->get();
    }

    public function create(array $data): Expense
    {
        $data['user_id'] = Auth::id();
        return Expense::create($data);
    }

    public function update(int $id, array $data): Expense
    {
        $expense = $this->findOrFail($id);
        $expense->update($data);
        return $expense;
    }

    public function findOrFail(int $id): Expense
    {
        return Expense::where('user_id', Auth::id())->findOrFail($id);
    }

    public function delete(int $id): void
    {
        $this->findOrFail($id)->delete();
    }
}
