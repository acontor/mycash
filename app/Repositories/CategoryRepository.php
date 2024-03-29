<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategoriesOrderedByType(): Collection
    {
        return auth()->user()->categories;
    }

    public function createCategory(array $categoryData): Category
    {
        return Category::create([
            'color'   => $categoryData['color'],
            'icon'    => $categoryData['icon'],
            'name'    => $categoryData['name'],
            'type'    => $categoryData['type'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function updateCategory(Category $category, array $categoryData): void
    {
        $category->update([
            'color'   => $categoryData['color'],
            'icon'    => $categoryData['icon'],
            'name'    => $categoryData['name'],
        ]);
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
