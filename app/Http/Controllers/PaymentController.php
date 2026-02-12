<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index()
    {
        // Only confirmed orders
        $orders = Order::where('status', 'confirmed')->orderBy('ordered_at', 'desc')->get();

        return view('pages.erp.payments.index', compact('orders'));
    }
}
