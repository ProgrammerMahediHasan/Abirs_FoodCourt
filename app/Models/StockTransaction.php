<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'product_id',
        'reference_type',
        'reference_id',
        'type',
        'quantity',
        'unit_cost',
        'total_cost',
        'notes',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Update product stock
    protected static function booted()
    {
        static::created(function ($transaction) {
            $product = $transaction->product;

            if ($transaction->type == 'in') {
                $product->current_stock += $transaction->quantity;
            } else {
                $product->current_stock -= $transaction->quantity;
            }

            $product->save();
        });

        static::deleted(function ($transaction) {
            $product = $transaction->product;

            if ($transaction->type == 'in') {
                $product->current_stock -= $transaction->quantity;
            } else {
                $product->current_stock += $transaction->quantity;
            }

            $product->save();
        });
    }
}
