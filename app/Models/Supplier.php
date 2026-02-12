<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'address',
        'supplier_type',
        'balance',
        'payment_terms',
        'is_active'
    ];

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Cascade Delete
    protected static function booted()
    {
        static::deleting(function ($supplier) {
            $supplier->products()->delete();       // Delete all products
            $supplier->purchaseOrders()->delete(); // Delete all purchase orders
        });
    }
}