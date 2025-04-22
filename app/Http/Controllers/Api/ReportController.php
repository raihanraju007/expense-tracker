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

    // public function timeline(Request $request)
    // {
    //     return ApiResponse::success(
    //         $this->service->expenseTimeline($request->start_date, $request->end_date),
    //         'Expense Timeline'
    //     );
    // }

    // public function customPeriod(Request $request)
    // {
    //     return ApiResponse::success(
    //         $this->service->customPeriodReport($request->start_date, $request->end_date),
    //         'Custom Period Report'
    //     );
    // }
}
