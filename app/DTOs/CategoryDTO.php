<?php 
namespace App\DTOs;

use App\Models\Category;

class CategoryDTO
{
    public static function fromModel(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'is_active' => $category->is_active,
            'created_by' => $category->created_by,
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
        ];
    }

    public static function collection($categories): array
    {
        return $categories->map(fn($category) => self::fromModel($category))->toArray();
    }
}
