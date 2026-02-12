<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Create Order
            $order = Order::create([
                'customer_id' => $data['customer_id'] ?? null,
                'restaurant_id' => $data['restaurant_id'] ?? null,
                'order_type' => $data['order_type'],
                'note' => $data['note'] ?? null,
                'discount' => $data['discount'] ?? 0,
            ]);

            // 2. Add Order Items
            foreach ($data['items'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);

                $order->items()->create([
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $menu->price,
                    'special_request' => $item['special_request'] ?? null,
                ]);
            }

            // Events automatically triggered from model

            return $order;
        });
    }
}
