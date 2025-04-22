<?php

namespace App\ServiceImpl;

use App\Services\BudgetService;
use App\Repositories\BudgetRepository;
use App\DTOs\BudgetDTO;
use Illuminate\Support\Facades\Auth;

class BudgetServiceImpl implements BudgetService
{
    public function __construct(protected BudgetRepository $repo) {}

    public function index(): array
    {
        return BudgetDTO::collection($this->repo->all());
    }

    public function store(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['month_year'] = substr($data['month_year'], 0, 7) . '-01';
        return BudgetDTO::fromModel($this->repo->create($data));
    }

    public function show(int $id): array
    {
        return BudgetDTO::fromModel($this->repo->findOrFail($id));
    }

    public function update(int $id, array $data): array
    {
        $data['month_year'] = substr($data['month_year'], 0, 7) . '-01';
        return BudgetDTO::fromModel($this->repo->update($id, $data));
    }

    public function destroy(int $id): void
    {
        $this->repo->delete($id);
    }
}
