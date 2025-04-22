<?php

namespace App\Services;

interface ReportService
{
    public function monthlyExpenseSummary(): array;
    public function categoryWiseAnalysis(): array; 
    public function budgetVsActual(): array;
    public function historicalTrends(): array;
    // public function expenseTimeline(): array;
    // public function customPeriodReport(array $filters): array;
}
