<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'unit',
        'current_stock',
        'reorder_level',
        'last_purchase_price',
        'supplier_id',
        'description',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    // Check if stock is low
    public function isLowStock()
    {
        return $this->current_stock <= $this->reorder_level;
    }

    // 🔥 Cascade Delete
    protected static function booted()
    {
        static::deleting(function ($product) {
            // যখন product delete হবে, তখন তার purchaseOrderItems delete হবে
            $product->purchaseOrderItems()->delete();
        });
    }
}