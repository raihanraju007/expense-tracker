<?php

namespace App\Repositories;

use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetRepository
{
    public function all()
    {
        return Budget::where('user_id', Auth::id())->latest()->get();
    }

    public function create(array $data): Budget
    {
        return Budget::create($data);
    }

    public function findOrFail(int $id): Budget
    {
        return Budget::where('user_id', Auth::id())->findOrFail($id);
    }

    public function update(int $id, array $data): Budget
    {
        $budget = $this->findOrFail($id);
        $budget->update($data);
        return $budget;
    }

    public function delete(int $id): void
    {
        $this->findOrFail($id)->delete();
    }
}
