<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
{
    $categories = Category::with(['laptops.images'])->get();

    return view('home', compact('categories'));
}
}
