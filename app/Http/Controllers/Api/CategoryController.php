<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Helpers\ApiResponse;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service) {}

    public function index()
    {
        return ApiResponse::success($this->service->index(), 'Category list fetched successfully');
    }

    public function store(CategoryRequest $request)
    {
        return ApiResponse::created($this->service->store($request->validated()), 'Category created successfully');
    }

    public function show($id)
    {
        return ApiResponse::success($this->service->show($id), 'Category details fetched');
    }

    public function update(CategoryRequest $request, $id)
    {
        return ApiResponse::success($this->service->update($id, $request->validated()), 'Category updated successfully');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return ApiResponse::deleted('Category deleted successfully');
    }
}

