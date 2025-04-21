<?php 

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::latest()->get();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function findOrFail(int $id)
    {
        return Category::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $category = $this->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $this->findOrFail($id)->delete();
    }
}

