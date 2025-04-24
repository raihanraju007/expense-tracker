<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;

class ReportController extends Controller
{
    public function __construct(protected ReportService $service) {}

    public function monthlySummary()
    {
        return ApiResponse::success($this->service->monthlyExpenseSummary(), 'Monthly Summary Report');
    }

    public function categoryWise()
    {
        return ApiResponse::success($this->service->categoryWiseAnalysis(), 'Category-wise Spending Report');
    }

    public function budgetVsActual()
    {
        return ApiResponse::success($this->service->budgetVsActual(), 'Budget vs. Actual Report');
    }

    public function historicalTrends()
    {
        return ApiResponse::success($this->service->historicalTrends(), 'Historical Spending Trends');
    }

    public function topDays()
    {
        return ApiResponse::success($this->service->topSpendingDays(), 'Top 5 Spending Days');
    }

    public function mostFrequent()
    {
        return ApiResponse::success($this->service->mostFrequentCategory(), 'Most Frequently Used Category');
    }
}
