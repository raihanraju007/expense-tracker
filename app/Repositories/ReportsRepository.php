<?php

namespace App\Repositories;

use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportsRepository
{
    public function getMonthlyBudget(): ?Budget
    {
        return Budget::where('user_id', Auth::id())
            ->whereMonth('month_year', now()->month)
            ->whereYear('month_year', now()->year)
            ->first();
    }

    public function getMonthlyExpenses(): Collection
    {
        return Expense::where('user_id', Auth::id())
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->with('category')
            ->get();
    }

    public function getMonthlyExpenseSum(): float
    {
        return Expense::where('user_id', Auth::id())
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');
    }

    public function getHistoricalTrends(): Collection
    {
        return Expense::selectRaw('DATE_FORMAT(date, "%Y-%m") as month, SUM(amount) as total')
            ->where('user_id', Auth::id())
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function getTopSpendingDays(): Collection
    {
        return Expense::where('user_id', Auth::id())
            ->selectRaw('date, SUM(amount) as total')
            ->groupBy('date')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    public function getMostFrequentCategory(): ?object
    {
        return Expense::where('user_id', Auth::id())
            ->selectRaw('category_id, COUNT(*) as count')
            ->groupBy('category_id')
            ->with('category')
            ->orderByDesc('count')
            ->first();
    }
}
