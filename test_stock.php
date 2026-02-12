<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $menu = App\Models\Menu::with('stock')->first();
    if ($menu) {
        echo "Menu: " . $menu->name . "\n";
        echo "Stock: " . ($menu->stock ? $menu->stock->current_quantity : "No Stock Entry") . "\n";
    } else {
        echo "No menus found.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
