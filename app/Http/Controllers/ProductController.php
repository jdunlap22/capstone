<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('products.index', compact('categories', 'items'));
    }

    public function show($id)
    {
        $product = Item::find($id);
        $items = Item::all();
        return view('products.show', compact('product', 'items'));
    }
}
