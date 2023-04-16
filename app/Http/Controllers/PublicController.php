<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class PublicController extends Controller
{
    public function setSession() {

        $sessionId = session()->getId();

        // Get the shopper's IP address
        $ipAddress = request()->ip();

        // Set the session variables
        session(['session_id' => $sessionId, 'ip_address' => $ipAddress]);
    }

    public function index($id)
    {
        $this->setSession();
        $categories = Category::all();
        $products = Item::find($id);
        return view('products.index', compact('categories', 'products'));
    }

    public function showCategory($id)
    {
        $this->setSession();

        //grabs single category by id
        $category = Category::find($id);
        //stores category item into variable
        $items = $category->items;
        //grab all categories
        $categories = Category::all();
        //returns product view index blade with passing on variables above
        return view('products.index', compact('categories', 'items'));
    }
}

