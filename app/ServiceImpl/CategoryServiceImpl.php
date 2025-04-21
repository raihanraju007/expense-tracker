<?php 

namespace App\ServiceImpl;

use App\Services\CategoryService;
use App\Repositories\CategoryRepository;
use App\DTOs\CategoryDTO;
use Illuminate\Support\Facades\Auth;

class CategoryServiceImpl implements CategoryService
{
    public function __construct(protected CategoryRepository $repo) {}

    public function index(): array
    {
        return CategoryDTO::collection($this->repo->all());
    }

    public function store(array $data): array
    {
        return CategoryDTO::fromModel($this->repo->create($data));
    }

    public function show(int $id): array
    {
        return CategoryDTO::fromModel($this->repo->findOrFail($id));
    }

    public function update(int $id, array $data): array
    {
        return CategoryDTO::fromModel($this->repo->update($id, $data));
    }

    public function destroy(int $id): void
    {
        $this->repo->delete($id);
    }
}

