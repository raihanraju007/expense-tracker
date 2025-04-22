<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BudgetRequest;
use App\Services\BudgetService;
use App\Helpers\ApiResponse;

class BudgetController extends Controller
{
    public function __construct(protected BudgetService $service) {}

    public function index()
    {
        return ApiResponse::success($this->service->index(), 'Budget list fetched successfully');
    }

    public function store(BudgetRequest $request)
    {
        return ApiResponse::created($this->service->store($request->validated()), 'Budget created successfully');
    }

    public function show($id)
    {
        return ApiResponse::success($this->service->show($id), 'Budget details fetched');
    }

    public function update(BudgetRequest $request, $id)
    {
        return ApiResponse::success($this->service->update($id, $request->validated()), 'Budget updated successfully');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return ApiResponse::deleted('Budget deleted successfully');
    }
}
