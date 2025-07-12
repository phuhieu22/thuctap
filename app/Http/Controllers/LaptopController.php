<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLaptopRequest;
use App\Http\Requests\UpdateLaptopRequest;
use App\Services\LaptopService;

class LaptopController extends Controller
{
    protected $laptopService;

    public function __construct(LaptopService $laptopService)
    {
        $this->laptopService = $laptopService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['brand_id', 'category_id', 'price_min', 'price_max', 'search']);
        $laptops = $this->laptopService->getAllLaptops($filters);

        return view('admin.laptops.index', compact('laptops', 'filters'));
    }

    public function create()
    {
        // Get brands and categories for the form
        $brands = \App\Models\Brand::all();
        $categories = \App\Models\Category::all();
        $promotions = \App\Models\Promotion::all();

        return view('admin.laptops.create', compact('brands', 'categories', 'promotions'));
    }

    public function store(StoreLaptopRequest $request)
    {
        $data = $request->validated();
        $images = $request->file('images', []);
        $promotionIds = $request->input('promotions', []);

        $laptop = $this->laptopService->storeLaptop($data, $images, $promotionIds);

        return redirect()->route('admin.laptops.show', $laptop->id)
            ->with('success', 'Laptop created successfully.');
    }

    public function show(int $id)
    {
        $laptop = $this->laptopService->getLaptopById($id);

        return view('admin.laptops.show', compact('laptop'));
    }

    public function edit(int $id)
    {
        $laptop = $this->laptopService->getLaptopById($id);
        $brands = \App\Models\Brand::all();
        $categories = \App\Models\Category::all();
        $promotions = \App\Models\Promotion::all();

        return view('admin.laptops.edit', compact('laptop', 'brands', 'categories', 'promotions'));
    }

    public function update(UpdateLaptopRequest $request, int $id)
    {
        $data = $request->validated();
        $images = $request->file('images', []);
        $deleteImageIds = $request->input('delete_image_ids', []);
        $promotionIds = $request->input('promotions', []);

        $laptop = $this->laptopService->updateLaptop($id, $data, $images, $deleteImageIds, $promotionIds);

        return redirect()->route('admin.laptops.show', $laptop->id)
            ->with('success', 'Laptop updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->laptopService->deleteLaptop($id);

        return redirect()->route('admin.laptops.index')
            ->with('success', 'Laptop deleted successfully.');
    }
}
