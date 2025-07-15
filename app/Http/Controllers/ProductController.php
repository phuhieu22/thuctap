<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Laptop;
use Illuminate\Http\Request;

class ProductController extends Controller
{

public function index(Request $request)
{
    $query = Laptop::with(['brand', 'images']);

    // Tìm kiếm theo tên
    if ($request->filled('search')) {
        $query->where('model', 'like', '%' . $request->search . '%');
    }

    // Lọc theo danh mục
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Lọc theo khoảng giá
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $laptops = $query->paginate(12); // có thể phân trang
    $categories = Category::all();

    return view('products.index', compact('laptops', 'categories'));
}
public function show($id)
{
    $laptop = Laptop::with(['images', 'brand', 'category'])
        ->findOrFail($id);

    return view('products.show', compact('laptop'));
}
}
