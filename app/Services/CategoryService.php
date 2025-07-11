<?php
namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Exception;
class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById(int $id): Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function storeCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(int $id, array $data): Category
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function destroyCategory(int $id): bool
    {
        // Check if the category has any associated laptops before deleting
        $category = $this->categoryRepository->findById($id);
        
        if ($category->laptops()->exists()) {
            throw new Exception(
                'Cannot delete category "' . $category->name . '" because it has associated laptops. ' .
                'Please remove all laptops from this category first.'
            );
        }

        return $this->categoryRepository->delete($id);
    }
}