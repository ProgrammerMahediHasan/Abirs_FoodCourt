<?php
namespace App\Listeners;

use App\Events\OrderItemCreated;

class CalculateOrderTotal
{
    public function handle(OrderItemCreated $event)
    {
        $order = $event->orderItem->order;
        $order->calculateTotals(); // Order model এর মেথড কল হবে
    }
}
