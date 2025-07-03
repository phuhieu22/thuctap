<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Exception;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->storeCategory($data);

        return redirect()->route('categories.show', $category->id)
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(int $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(int $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $data = $request->validated();
        $category = $this->categoryService->updateCategory($id, $data);

        return redirect()->route('categories.show', $category->id)
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->categoryService->destroyCategory($id);
            
            return redirect()->route('categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('categories.index')
                ->with('error', $e->getMessage());
        }
    }
}
