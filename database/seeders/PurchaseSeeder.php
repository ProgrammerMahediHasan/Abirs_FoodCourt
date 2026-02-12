<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        // Create Suppliers
        $suppliers = [
            [
                'name' => 'রহিম মাংস ভাণ্ডার',
                'phone' => '01711223344',
                'company_name' => 'রহিম ব্রাদার্স',
                'supplier_type' => 'food',
                'payment_terms' => 'cash'
            ],
            [
                'name' => 'করিম সবজি বিক্রেতা',
                'phone' => '01722334455',
                'company_name' => 'করিম ফার্মস',
                'supplier_type' => 'vegetable',
                'payment_terms' => '7 days credit'
            ],
            [
                'name' => 'আলম বেকারি',
                'phone' => '01733445566',
                'company_name' => 'আলম বেকারি হাউস',
                'supplier_type' => 'bakery',
                'payment_terms' => 'cash'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Create Products for Burger
        $products = [
            // Bun Products
            [
                'name' => 'Burger Bun',
                'code' => 'BUN-001',
                'unit' => 'piece',
                'current_stock' => 50,
                'reorder_level' => 20,
                'last_purchase_price' => 25,
                'supplier_id' => 3 // আলম বেকারি
            ],
            [
                'name' => 'Beef Patty',
                'code' => 'BEEF-001',
                'unit' => 'piece',
                'current_stock' => 30,
                'reorder_level' => 15,
                'last_purchase_price' => 100,
                'supplier_id' => 1 // রহিম মাংস ভাণ্ডার
            ],
            [
                'name' => 'Cheese Slice',
                'code' => 'CHS-001',
                'unit' => 'piece',
                'current_stock' => 40,
                'reorder_level' => 20,
                'last_purchase_price' => 20,
                'supplier_id' => 1
            ],
            [
                'name' => 'Lettuce',
                'code' => 'LET-001',
                'unit' => 'piece',
                'current_stock' => 5,
                'reorder_level' => 3,
                'last_purchase_price' => 50,
                'supplier_id' => 2 // করিম সবজি বিক্রেতা
            ],
            [
                'name' => 'Tomato',
                'code' => 'TOM-001',
                'unit' => 'kg',
                'current_stock' => 2,
                'reorder_level' => 1,
                'last_purchase_price' => 100,
                'supplier_id' => 2
            ],
            [
                'name' => 'Onion',
                'code' => 'ONI-001',
                'unit' => 'kg',
                'current_stock' => 5,
                'reorder_level' => 2,
                'last_purchase_price' => 80,
                'supplier_id' => 2
            ],
            [
                'name' => 'Burger Sauce',
                'code' => 'SAU-001',
                'unit' => 'liter',
                'current_stock' => 1,
                'reorder_level' => 0.5,
                'last_purchase_price' => 200,
                'supplier_id' => 1
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create Sample Purchase Order
        $purchase = PurchaseOrder::create([
            'po_number' => 'PO-2024-0001',
            'supplier_id' => 1,
            'order_date' => now()->subDays(2),
            'expected_delivery_date' => now()->addDays(1),
            'status' => 'received',
            'subtotal' => 1800,
            'grand_total' => 1800,
            'created_by' => 1
        ]);

        // Add Items to Purchase Order
        $items = [
            ['product_id' => 2, 'quantity' => 10, 'unit_price' => 100, 'received_quantity' => 10],
            ['product_id' => 3, 'quantity' => 20, 'unit_price' => 20, 'received_quantity' => 20],
            ['product_id' => 7, 'quantity' => 1, 'unit_price' => 200, 'received_quantity' => 1]
        ];

        foreach ($items as $item) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $purchase->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
                'received_quantity' => $item['received_quantity']
            ]);
        }
    }
}
