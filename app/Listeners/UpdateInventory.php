<?php
namespace App\Listeners;

use App\Events\OrderItemCreated;
use App\Models\Menu;
use App\Models\Inventory; // যদি inventory table থাকে

class UpdateInventory
{
    public function handle(OrderItemCreated $event)
    {
        $orderItem = $event->orderItem;
        $menu = $orderItem->menu;

        // যদি inventory management থাকে
        // if (class_exists('App\Models\Inventory')) {
        //     $inventory = Inventory::where('menu_id', $menu->id)->first();
        //     if ($inventory) {
        //         $inventory->decrement('quantity', $orderItem->quantity);

        //         // Low stock alert
        //         if ($inventory->quantity < $inventory->low_stock_threshold) {
        //             // Trigger low stock notification
        //             // event(new LowStockAlert($inventory));
        //         }
        //     }
        // }

        // Menu এর popularity update (optional)
        $menu->increment('order_count');
    }
}
