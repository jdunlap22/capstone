<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class PublicController extends Controller
{
    public function index($id)
    {
        $categories = Category::all();
        $products = Item::find($id);
        return view('products.index', compact('categories', 'products'));
    }

    public function showCategory($id)
    {
        //grabs single category by id
        $category = Category::find($id);
        //stores category item into variable
        $items = $category->items();
        //grab all categories
        $categories = Category::all();
        //returns product view index blade with passing on variables above
        return view('products.index', compact('categories', 'items'));
    }

    public function showProduct($id)
    {
        $product = Item::find($id);
        return view('products.show', compact('product'));
    }
}
