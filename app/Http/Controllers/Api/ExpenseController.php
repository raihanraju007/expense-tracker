<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Services\ExpenseService;
use App\Helpers\ApiResponse;

class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $service) {}

    public function index()
    {
        return ApiResponse::success($this->service->index(), 'Expense list fetched successfully');
    }

    public function store(ExpenseRequest $request)
    {
        return ApiResponse::created($this->service->store($request->validated()), 'Expense created successfully');
    }

    public function show($id)
    {
        return ApiResponse::success($this->service->show($id), 'Expense details fetched');
    }

    public function update(ExpenseRequest $request, $id)
    {
        return ApiResponse::success($this->service->update($id, $request->validated()), 'Expense updated successfully');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return ApiResponse::deleted('Expense deleted successfully');
    }
}
