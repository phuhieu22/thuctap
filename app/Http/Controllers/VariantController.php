<?php

namespace App\Http\Controllers;

use App\Models\LaptopVariant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    // Hiển thị danh sách biến thể
    public function index()
    {
        $variants = LaptopVariant::paginate(10);
        return view('admin.variants.index', compact('variants'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        return view('admin.variants.create');
    }

    // Lưu biến thể mới
    public function store(Request $request)
    {
        $request->validate([
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'specifications' => 'nullable|string',
        ]);

        LaptopVariant::create($request->all());

        return redirect()->route('admin.variants.index')->with('success', 'Thêm biến thể thành công');
    }

    // Hiển thị chi tiết một biến thể
    public function show($id)
    {
        $variant = LaptopVariant::findOrFail($id);
        return view('admin.variants.show', compact('variant'));
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $variant = LaptopVariant::findOrFail($id);
        return view('admin.variants.edit', compact('variant'));
    }

    // Cập nhật biến thể
    public function update(Request $request, $id)
    {
        $request->validate([
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'specifications' => 'nullable|string',
        ]);

        $variant = LaptopVariant::findOrFail($id);
        $variant->update($request->all());

        return redirect()->route('admin.variants.index')->with('success', 'Cập nhật biến thể thành công');
    }

    // Xóa vĩnh viễn
    public function destroy($id)
    {
        $variant = LaptopVariant::findOrFail($id);
        $variant->delete();

        return redirect()->route('admin.variants.index')->with('success', 'Xóa biến thể thành công');
    }
}
