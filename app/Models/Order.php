<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Payment;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'order_no', 'customer_id', 'restaurant_id', 'order_type',
    'status', 'subtotal', 'total', 'note', 'ordered_at',
    'payment_status', 'payment_method', 'invoice_token'
];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'ordered_at' => 'datetime',
        'estimated_time' => 'datetime',
        'completed_at' => 'datetime',
        'status' => 'string',
        'order_type' => 'string',
        'payment_status' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'ordered_at',
        'estimated_time',
        'completed_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_no)) {
                $order->order_no = static::generateOrderNo();
            }

            if (empty($order->status)) {
                $order->status = 'pending';
            }

            if (empty($order->ordered_at)) {
                $order->ordered_at = now();
            }
        });

        static::created(function ($order) {
            // You can add any post-creation logic here
            // Example: Send notification, update inventory, etc.
        });
    }

    /**
     * Relationship with Customer
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relationship with Restaurant
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    /**
     * Relationship with Order Items
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Relationship with Payment (if you have payments table)
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    /**
     * Relationship with User (if staff manages orders)
     */
    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Generate unique order number
     */
    public static function generateOrderNo(): string
    {
        $prefix = 'ORD-' . date('Ymd') . '-';

        // Get the last order with today's prefix
        $lastOrder = self::where('order_no', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTRING(order_no, -4) AS UNSIGNED) DESC')
            ->first();

        if ($lastOrder) {
            // Extract the numeric part
            $lastNo = intval(substr($lastOrder->order_no, -4));
            $newNo = str_pad($lastNo + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNo = '0001';
        }

        return $prefix . $newNo;
    }

    /**
     * Scope for pending orders
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for completed orders
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->whereIn('status', ['delivered', 'completed']);
    }

    /**
     * Scope for today's orders
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('ordered_at', today());
    }

    /**
     * Scope for orders by status
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for orders by type
     */
    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('order_type', $type);
    }

    /**
     * Scope for orders by restaurant
     */
    public function scopeByRestaurant(Builder $query, int $restaurantId): Builder
    {
        return $query->where('restaurant_id', $restaurantId);
    }

    /**
     * Scope for orders by date range
     */
    public function scopeDateRange(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('ordered_at', [$startDate, $endDate]);
    }

    /**
     * Check if order is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if order is confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if order is preparing
     */
    public function isPreparing(): bool
    {
        return $this->status === 'preparing';
    }

    /**
     * Check if order is ready
     */
    public function isReady(): bool
    {
        return $this->status === 'ready';
    }

    /**
     * Check if order is delivered
     */
    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    /**
     * Check if order is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if order can be edited (only pending orders)
     */
    public function canBeEdited(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }

    /**
     * Check if order can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed', 'preparing']);
    }

    /**
     * Calculate order total with tax and discount
     */
    public function calculateTotal(): float
    {
        $subtotal = $this->subtotal ?? 0;
        $tax = $this->tax ?? 0;
        $discount = $this->discount ?? 0;

        return $subtotal + $tax - $discount;
    }

    /**
     * Update order totals based on items
     */
    public function updateTotals(): self
    {
        $subtotal = $this->items->sum('total_price');
        $tax = $subtotal * 0.10; // 10% VAT
        $total = $subtotal + $tax - ($this->discount ?? 0);

        $this->update([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);

        return $this;
    }

    /**
     * Change order status with validation
     */
    public function changeStatus(string $newStatus): bool
    {
        $validStatuses = ['pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled'];

        if (!in_array($newStatus, $validStatuses)) {
            return false;
        }

        $this->update(['status' => $newStatus]);

        // Delivered timestamp column may not exist; rely on updated_at

        return true;
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadge(): string
    {
        $statusConfig = [
            'pending' => ['class' => 'badge bg-warning', 'icon' => 'clock'],
            'confirmed' => ['class' => 'badge bg-primary', 'icon' => 'check-circle'],
            'preparing' => ['class' => 'badge bg-info', 'icon' => 'utensils'],
            'ready' => ['class' => 'badge bg-success', 'icon' => 'check-double'],
            'delivered' => ['class' => 'badge bg-dark', 'icon' => 'truck'],
            'cancelled' => ['class' => 'badge bg-danger', 'icon' => 'times-circle']
        ];

        $config = $statusConfig[$this->status] ?? ['class' => 'badge bg-secondary', 'icon' => 'question'];

        return sprintf(
            '<span class="%s"><i class="fas fa-%s me-1"></i>%s</span>',
            $config['class'],
            $config['icon'],
            ucfirst($this->status)
        );
    }

    /**
     * Get order type badge HTML
     */
    public function getTypeBadge(): string
    {
        $typeConfig = [
            'dine_in' => ['class' => 'badge bg-primary', 'icon' => 'utensils'],
            'takeaway' => ['class' => 'badge bg-success', 'icon' => 'box'],
            'delivery' => ['class' => 'badge bg-info', 'icon' => 'truck']
        ];

        $config = $typeConfig[$this->order_type] ?? ['class' => 'badge bg-secondary', 'icon' => 'question'];

        return sprintf(
            '<span class="%s"><i class="fas fa-%s me-1"></i>%s</span>',
            $config['class'],
            $config['icon'],
            ucfirst(str_replace('_', ' ', $this->order_type))
        );
    }

    /**
     * Get formatted total amount
     */
    public function getFormattedTotal(): string
    {
        return '৳' . number_format($this->total, 2);
    }

    /**
     * Get formatted ordered date
     */
    public function getOrderedDateFormatted(): string
    {
        return $this->ordered_at->format('d M Y, h:i A');
    }

    /**
     * Get estimated delivery time
     */
    public function getEstimatedTimeFormatted(): ?string
    {
        return $this->estimated_time ? $this->estimated_time->format('h:i A') : null;
    }

    /**
     * Search orders by order no, customer name, phone
     */
    public static function search(string $search): Builder
    {
        return self::where('order_no', 'like', "%{$search}%")
            ->orWhereHas('customer', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
    }

    /**
     * Get statistics for dashboard
     */
    public static function getDashboardStats(): array
    {
        $totalOrders = self::count();
        $todayOrders = self::today()->count();
        $totalRevenue = self::sum('total');
        $todayRevenue = self::today()->sum('total');
        $pendingOrders = self::pending()->count();

        return [
            'total_orders' => $totalOrders,
            'today_orders' => $todayOrders,
            'total_revenue' => $totalRevenue,
            'today_revenue' => $todayRevenue,
            'pending_orders' => $pendingOrders,
            'avg_order_value' => $totalOrders > 0 ? $totalRevenue / $totalOrders : 0
        ];
    }

    /**
     * Get recent orders
     */
    public static function getRecentOrders(int $limit = 10)
    {
        return self::with(['customer', 'restaurant'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get order timeline/activity (if you have activity log)
     */
    public function getTimeline()
    {
        // Implement if you have activity log
        return [];
    }

    /**
     * Check if order has items
     */
    public function hasItems(): bool
    {
        return $this->items()->exists();
    }

    /**
     * Get order items count
     */
    public function itemsCount(): int
    {
        return $this->items()->count();
    }

    /**
     * Get order items total quantity
     */
    public function totalQuantity(): int
    {
        return $this->items()->sum('quantity');
    }};
