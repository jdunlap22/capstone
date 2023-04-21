<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Sold;
use App\Models\Checkout;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {

        $categories = Category::all();
        $items = Item::all();
        return view('products.shopping_cart', compact('categories', 'items'));
    }

    public function showCart()
    {
        $cartItems = Cart::where('session_id', session()->getId())->where('ip_address', request()->ip())->get();
        $subtotal = 0;
        foreach($cartItems as $cartItem) {
            $subtotal += $cartItem->item->price * $cartItem->quantity;
        }
        return view('products.shopping_cart', compact('cartItems', 'subtotal'));
    }


    public function store($request)
    { 
        $cart = new Cart;
        $cart->item_id = $request;
        $cart->session_id = session()->getId();
        $cart->ip_address = request()->ip();
        $cart->quantity = 1;
        $cart-> save();

        Session::flash('success','The item has been added');

        return redirect()->route('cart.showCart', ['id' => $request]);
    }

    public function update(Request $request, $id) 
    {
        
        $cart = Cart::findOrFail($id);
        if ($request->input('quantity') <= $cart->item->quantity) {
        $cart->quantity = $request->input('quantity');
        $cart->save();
        } else {
            Session::flash('quantity exceeds item inventory');
        }

        return redirect()->route('cart.showCart');
    }

    public function delete($id) 
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart.showCart');
    }

    public function checkOut(Request $request) {
        
        if (!session()->has('session_id')) {
            return redirect()->route('products.index');
        }

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $checkout = new Checkout;
        $checkout->first_name = $request->first_name;
        $checkout->last_name = $request->last_name;
        $checkout->phone = $request->phone;
        $checkout->email = $request->email;
        $checkout->session_id = session()->getId();
        $checkout->ip_address = request()->ip();
        $checkout->save();

        $cartItems = Cart::where('session_id', session()->getId())->where('ip_address', request()->ip())->get();
        foreach($cartItems as $cartItem){
            $sold = new Sold;
            $sold->item_id = $cartItem->item_id;
            $sold->order_id = $checkout->id;
            $sold->item_price = $cartItem->item->price;
            $sold->quantity = $cartItem->quantity;
            $sold->save();
            $cartItem->delete();
        }
    
    
    return redirect()->route('thankyou', ['id' => $checkout->id]);
    }

    public function thankYou($id) 
    {
        $subtotal = 0;
        $checkout = Checkout::findOrFail($id);
        $cartItems = Sold::where('order_id', $checkout->id)->get();
        foreach($cartItems as $soldItem) {
            $subtotal += $soldItem->item_price * $soldItem->quantity;
        }

        session()->forget('session_id');
        return view ('products.thankyou', compact('checkout', 'subtotal'));
    }

    public function emptyCart() 
    {
        Cart::truncate();
    }
}