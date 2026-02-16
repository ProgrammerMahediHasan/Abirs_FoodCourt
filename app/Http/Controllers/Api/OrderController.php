<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer.name' => ['required', 'string', 'max:255'],
            'customer.phone' => ['required', 'string', 'max:50'],
            'customer.address' => ['required', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_id' => ['required', 'integer', 'exists:menus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'total' => ['required', 'numeric', 'min:0'],
        ]);

        return DB::transaction(function () use ($validated) {
            $customerData = $validated['customer'];

            $customer = Customer::firstOrCreate(
                ['phone' => $customerData['phone']],
                [
                    'name' => $customerData['name'],
                    'address' => $customerData['address'],
                ]
            );

            $restaurant = Restaurant::first();

            $order = Order::create([
                'order_no' => 'API-' . now()->format('YmdHis'),
                'customer_id' => $customer->id,
                'restaurant_id' => $restaurant?->id,
                'order_type' => 'delivery',
                'status' => 'pending',
                'subtotal' => 0,
                'total' => 0,
                'note' => null,
                'ordered_at' => now(),
                'payment_status' => 'paid',
                'payment_method' => 'card',
            ]);

            $subtotal = 0;

            foreach ($validated['items'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $quantity = $item['quantity'];
                $lineTotal = $menu->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $quantity,
                    'unit_price' => $menu->price,
                    'total_price' => $lineTotal,
                ]);

                $subtotal += $lineTotal;
            }

            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal,
            ]);

            return response()->json([
                'id' => $order->id,
                'order_no' => $order->order_no,
                'total' => $order->total,
            ], 201);
        });
    }
}

