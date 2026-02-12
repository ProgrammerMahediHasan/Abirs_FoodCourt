<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\OrderCreated::class => [
            \App\Listeners\SendOrderNotification::class,
        ],
        \App\Events\OrderItemCreated::class => [
            \App\Listeners\UpdateInventory::class,
            \App\Listeners\CalculateOrderTotal::class,
        ],
        // \App\Events\OrderStatusUpdated::class => [
        //     \App\Listeners\SendStatusUpdateNotification::class,
        // ],
    ];
}
