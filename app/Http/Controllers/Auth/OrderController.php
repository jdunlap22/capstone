<?php

namespace App\Http\Controllers;

use App\Models\Checkout;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::whereNotNull('completed_at')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Checkout::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}