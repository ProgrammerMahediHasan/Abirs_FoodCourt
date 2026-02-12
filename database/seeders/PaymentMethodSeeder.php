<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $methods = [
            ['name' => 'Cash', 'code' => 'cash', 'icon' => 'fa-money-bill', 'is_active' => true],
            ['name' => 'Credit Card', 'code' => 'card', 'icon' => 'fa-credit-card', 'is_active' => true],
            ['name' => 'bKash', 'code' => 'bkash', 'icon' => 'fa-mobile-alt', 'is_active' => true],
            ['name' => 'Nagad', 'code' => 'nagad', 'icon' => 'fa-wallet', 'is_active' => true],
            ['name' => 'Rocket', 'code' => 'rocket', 'icon' => 'fa-rocket', 'is_active' => true],
            ['name' => 'Bank Transfer', 'code' => 'bank', 'icon' => 'fa-university', 'is_active' => true],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
