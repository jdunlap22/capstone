<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('products.shopping_cart', compact('categories', 'items'));
    }

    public function showCart($id)
    {
        $this->store($id);
        $product = Item::find($id);
        $cartItem = Cart::where('item_id', $id)->get();
        dd($cartItem);
        $subtotal = $cartItem->items->price * $cartItem->quantity;
        return view('products.shopping_cart', compact('product', 'cartItem', 'subtotal'));
    }

    public function store($request)
    { 
        $cart = new Cart;
        $cart->item_id = $request;
        $cart->session_id = session()->getId();
        $cart->ip_address = request()->ip();
        $cart->quantity = 1;

        Session::flash('success','The item has been added');

        return redirect()->route('cart.showCart');
    }
}