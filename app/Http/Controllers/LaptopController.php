<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::with(['brand', 'category', 'images'])
            ->where('stock', '>', 0)
            ->paginate(12);
        
        return view('laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('laptops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Laptop::create($request->only([
            'brand_id',
            'category_id',
            'model',
            'price',
            'stock',
            'description',
        ]));

        return redirect()->route('laptops.index')->with('success', 'Laptop created successfully.');
    }

    public function show($id)
    {
        $laptop = Laptop::with([
            'brand',
            'category', 
            'images',
            'variants'
        ])->findOrFail($id);

        $relatedLaptops = Laptop::with(['brand', 'images'])
            ->where('category_id', $laptop->category_id)
            ->where('id', '!=', $laptop->id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();

        return view('product-details', compact('laptop', 'relatedLaptops'));
    }
}
