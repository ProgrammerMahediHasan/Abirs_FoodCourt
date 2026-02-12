<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'supplier_id',
        'order_date',
        'expected_delivery_date',
        'delivery_date',
        'status',
        'subtotal',
        'tax',
        'discount',
        'shipping',
        'grand_total',
        'notes',
        'created_by',
        'approved_by'
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_delivery_date' => 'date',
        'delivery_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Generate PO Number
    public static function generatePONumber()
    {
        $prefix = 'PO-' . date('Y') . '-';
        $lastPO = self::where('po_number', 'like', $prefix . '%')->orderBy('id', 'desc')->first();

        if ($lastPO) {
            $lastNumber = intval(substr($lastPO->po_number, strlen($prefix)));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    // Update totals
    public function updateTotals()
    {
        $subtotal = $this->items()->sum('total_price');

        $this->update([
            'subtotal' => $subtotal,
            'grand_total' => $subtotal + $this->tax + $this->shipping - $this->discount
        ]);
    }
}
