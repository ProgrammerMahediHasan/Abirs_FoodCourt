<?php
namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class SendOrderNotification
{
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        // 1. Log order creation
        Log::info('New order placed', ['order_no' => $order->order_no]);

        // 2. Send email to customer if email exists
        // if ($order->customer && $order->customer->email) {
        //     Mail::to($order->customer->email)
        //         ->queue(new App\Listeners\OrderConfirmationMail($order));
        // }

        // 3. Send notification to restaurant (you can use SMS, Pusher, etc.)
        // Example: Notification::send($restaurantAdmins, new NewOrderNotification($order));

        // 4. Update restaurant dashboard in real-time (if using websockets)
        // broadcast(new OrderPlaced($order));
    }
}
