<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Item::all();
        return view('public.index', compact('categories', 'products'));
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->items()->get();
        return view('public.category', compact('category', 'products'));
    }

    public function showProduct($id)
    {
        $product = Item::findOrFail($id);
        return view('public.product', compact('product'));
    }
}
