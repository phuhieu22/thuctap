<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::with('laptops')->orderBy('name')->get();
    }

    public function findById(int $id): Category
    {
        return Category::with('laptops')->findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): Category
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category->fresh();
    }

    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
