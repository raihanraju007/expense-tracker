<?php

namespace App\ServiceImpl;

use App\Services\ReportService;
use App\Repositories\ReportsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class ReportServiceImpl implements ReportService
{
    public function __construct(protected ReportsRepository $repo) {}

    public function monthlyExpenseSummary(): array
    {
        $budget = $this->repo->getMonthlyBudget();
        $expenses = $this->repo->getMonthlyExpenses();
        $totalSpent = $expenses->sum('amount');

        $summary = [
            'budget_amount' => $budget?->amount ?? 0,
            'total_spent' => $totalSpent,
            'budget_used_percentage' => $budget ? round(($totalSpent / $budget->amount) * 100, 2) : 0,
            'categories' => $expenses->groupBy('category_id')->map(function ($group) {
                return [
                    'total' => $group->sum('amount'),
                    'category_name' => optional($group->first()->category)->name,
                ];
            })->values(),
        ];

        return $summary;
    }

    public function categoryWiseAnalysis(): array
    {
        $expenses = $this->repo->getMonthlyExpenses();

        $categoryBreakdown = $expenses->groupBy('category_id')->map(function ($group) {
            return [
                'category' => optional($group->first()->category)->name,
                'total_spent' => $group->sum('amount'),
            ];
        })->values();

        return [
            'breakdown' => $categoryBreakdown,
            'most_expensive' => $categoryBreakdown->sortByDesc('total_spent')->first(),
            'least_expensive' => $categoryBreakdown->sortBy('total_spent')->first(),
        ];
    }

    public function budgetVsActual(): array
    {
        $budget = $this->repo->getMonthlyBudget();
        $spent = $this->repo->getMonthlyExpenseSum();

        return [
            'budget' => $budget?->amount ?? 0,
            'actual_spent' => $spent,
            'difference' => ($budget?->amount ?? 0) - $spent,
            'status' => $spent > ($budget?->amount ?? 0) ? 'Over Budget' : 'Under Budget',
        ];
    }

    public function historicalTrends(): array
    {
        return $this->repo->getHistoricalTrends()->map(function ($entry) {
            return [
                'month' => $entry->month,
                'total_spent' => $entry->total,
            ];
        })->toArray();
    }

    // public function expenseTimeline(string $start = null, string $end = null): array
    // {
    //     return $this->repo->getExpensesBetween($start, $end)->map(function ($expense) {
    //         return [
    //             'date' => $expense->date,
    //             'amount' => $expense->amount,
    //             'category' => optional($expense->category)->name,
    //             'description' => $expense->description,
    //         ];
    //     })->toArray();
    // }

    // public function customPeriodReport(string $start, string $end): array
    // {
    //     $expenses = $this->repo->getExpensesBetween($start, $end);
    //     return [
    //         'total' => $expenses->sum('amount'),
    //         'category_summary' => $expenses->groupBy('category_id')->map(function ($group) {
    //             return [
    //                 'category' => optional($group->first()->category)->name,
    //                 'total_spent' => $group->sum('amount'),
    //             ];
    //         })->values(),
    //     ];
    // }
}
