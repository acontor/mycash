<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAllCategoriesOrderedByType(): Collection;
    public function createCategory(array $categoryData): Category;
    public function updateCategory(Category $category, array $categoryData): void;
    public function deleteCategory(Category $category): void;
}
