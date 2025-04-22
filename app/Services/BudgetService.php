<?php

namespace App\Services;

interface BudgetService
{
    public function index(): array;
    public function store(array $data): array;
    public function show(int $id): array;
    public function update(int $id, array $data): array;
    public function destroy(int $id): void;
}
