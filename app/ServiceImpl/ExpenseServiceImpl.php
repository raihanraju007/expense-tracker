<?php

namespace App\ServiceImpl;

use App\Services\ExpenseService;
use App\Repositories\ExpenseRepository;
use App\DTOs\ExpenseDTO;

class ExpenseServiceImpl implements ExpenseService
{
    public function __construct(protected ExpenseRepository $repo) {}

    public function index(): array
    {
        return ExpenseDTO::collection($this->repo->all());
    }

    public function store(array $data): array
    {
        return ExpenseDTO::fromModel($this->repo->create($data));
    }

    public function show(int $id): array
    {
        return ExpenseDTO::fromModel($this->repo->findOrFail($id));
    }

    public function update(int $id, array $data): array
    {
        return ExpenseDTO::fromModel($this->repo->update($id, $data));
    }

    public function destroy(int $id): void
    {
        $this->repo->delete($id);
    }
}
