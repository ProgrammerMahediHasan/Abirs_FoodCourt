@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .transition-all {
        transition: all 0.3s ease;
    }
</style>

@php
$recentOrders = $recentOrders ?? collect([]);
$availableMenus = $availableMenus ?? collect([]);
$totalOrders = $totalOrders ?? 0;
$todayOrders = $todayOrders ?? 0;
$totalRevenue = $totalRevenue ?? 0;
$todayRevenue = $todayRevenue ?? 0;
$pendingOrders = $pendingOrders ?? 0;
$confirmedOrders = $confirmedOrders ?? 0;
$completedOrders = $completedOrders ?? 0;
$avgOrderValue = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;
$uniqueCustomers = $uniqueCustomers ?? 0;
$thisWeekOrders = $thisWeekOrders ?? 0;
$completionRate = $completionRate ?? 0;
@endphp

<div class="dashboard-container">

    <!-- Dashboard Header -->
    <div class="dashboard-header mb-5">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1 class="page-title mb-2">Welcome to Abir's FoodCourt</h1>
                <p class="page-subtitle text-muted">
                    <i class="fas fa-calendar-alt me-2"></i>
                    {{ \Carbon\Carbon::now('Asia/Dhaka')->format('l, F d, Y') }}
                    <span class="mx-3">•</span>
                    <i class="fas fa-clock me-2"></i>
                    <span id="dhakaTime">{{ \Carbon\Carbon::now('Asia/Dhaka')->format('h:i:s A') }}</span>
                </p>
            </div>

            {{-- <a href="{{ route('orders.create') }}" class="btn btn-primary"> --}}
            {{-- <i class="fas fa-plus-circle me-2"></i>New Order --}}


        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card p-3">
                <h5 class="mb-3">Today's Product Stock Availability</h5>
                <div id="chartStock" style="min-height: 360px;"></div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card p-3">
                <h5 class="mb-3">Today's Orders</h5>
                <div id="chartOrders" style="min-height: 320px;"></div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="mb-3">Available Products Chart</h5>
        @if($availableMenus->isEmpty())
        <div class="alert alert-info">No menu items found.</div>
        @else
        @php $slides = $availableMenus->chunk(9); @endphp
        <div id="foodStatusCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($slides as $slideIndex => $slide)
                <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
                    <div class="container">
                        @php $rows = $slide->chunk(3); @endphp
                        @foreach($rows as $row)
                        <div class="row">
                            @foreach($row as $menu)
                            @php
                                $statusText = 'Unavailable';
                                $badgeClass = 'bg-secondary';
                                if ($menu->stock) {
                                    if ($menu->stock->current_quantity > 0) {
                                        $statusText = 'Available Product';
                                        $badgeClass = 'bg-success';
                                    } else {
                                        $statusText = 'Stock-Out';
                                        $badgeClass = 'bg-danger';
                                    }
                                }
                            @endphp
                            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}" style="height: 180px; object-fit: cover;">
                                        @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                            <i class="fas fa-hamburger fa-3x text-muted"></i>
                                        </div>
                                        @endif
                                        <span class="badge {{ $badgeClass }} position-absolute top-0 end-0 m-2">{{ $statusText }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 fw-bold">{{ $menu->name }}</h6>
                                            <span class="text-primary fw-bold">৳{{ number_format($menu->price, 0) }}</span>
                                        </div>
                                        <p class="text-muted small mb-0">{{ $menu->category->name ?? 'Uncategorized' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#foodStatusCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#foodStatusCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @endif
    </div>

@section('scripts')
<script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>
<script>
    (function(){
        const el = document.getElementById('dhakaTime');
        function tick(){
            try {
                const now = new Date();
                el.textContent = now.toLocaleTimeString('en-US', {
                    hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true, timeZone: 'Asia/Dhaka'
                });
            } catch(e) {}
        }
        tick();
        setInterval(tick, 1000);
    })();
    const stockSeries = [{{ $stockAvailable }}, {{ $stockUnavailable }}, {{ $stockOut }}];
    const stockLabels = ['Available', 'Unavailable', 'Stock-Out'];
    const ordersLabels = ['Pending','Confirmed','Preparing','Ready','Delivered','Cancelled'];
    const ordersSeries = [
        {{ $todayOrdersByStatus['pending'] }},
        {{ $todayOrdersByStatus['confirmed'] }},
        {{ $todayOrdersByStatus['preparing'] }},
        {{ $todayOrdersByStatus['ready'] }},
        {{ $todayOrdersByStatus['delivered'] }},
        {{ $todayOrdersByStatus['cancelled'] }}
    ];
    const stockOptions = {
        chart: {
            type: 'donut',
            height: 360,
            animations: {
                enabled: true,
                speed: 800,
                animateGradually: { enabled: true, delay: 200 },
                dynamicAnimation: { enabled: true, speed: 400 }
            }
        },
        series: stockSeries,
        labels: stockLabels,
        colors: ['#10B981','#F59E0B','#EF4444'],
        legend: {
            position: 'bottom',
            markers: { width: 12, height: 12 },
            itemMargin: { horizontal: 10 }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val, opts) {
                return opts.w.config.series[opts.seriesIndex];
            },
            style: { fontSize: '14px', fontWeight: 600 }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.95,
                stops: [0, 80, 100]
            }
        },
        tooltip: {
            y: {
                formatter: function(value) { return value; }
            }
        },
        responsive: [
            { breakpoint: 1200, options: { chart: { height: 320 } } },
            { breakpoint: 992, options: { chart: { height: 300 } } },
            { breakpoint: 576, options: { chart: { height: 280 }, legend: { position: 'bottom' } } }
        ]
    };
    new ApexCharts(document.querySelector('#chartStock'), stockOptions).render();
    const ordersOptions = {
        chart: { type: 'bar', height: 320 },
        series: [{ name: 'Orders', data: ordersSeries }],
        xaxis: { categories: ordersLabels },
        colors: ['#FF7F50']
    };
    new ApexCharts(document.querySelector('#chartOrders'), ordersOptions).render();
</script>
@endsection

    <!-- Dashboard Content Grid -->
    {{-- <div class="dashboard-grid">
        <!-- Left Column: Recent Orders -->
        <div class="dashboard-left">
            <div class="recent-orders-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">
                            <i class="fas fa-history text-primary me-2"></i>
                            Recent Orders
                        </h5>
                        <p class="text-muted mb-0 small">Last 10 orders placed</p>
                    </div>
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">
    View All <i class="fas fa-arrow-right ms-1"></i>
    </a>
</div>
<div class="card-body">
    @if($recentOrders->isEmpty())
    <div class="empty-state text-center py-5">
        <div class="empty-icon mb-3">
            <i class="fas fa-shopping-cart fa-3x text-light"></i>
        </div>
        <h5 class="text-muted mb-2">No Recent Orders</h5>
        <p class="text-muted small mb-0">No orders have been placed yet</p>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus me-1"></i>Create First Order
        </a>
    </div>
    @else
    <div class="recent-orders-list">
        @foreach($recentOrders as $order)
        <div class="order-item">
            <div class="order-header">
                <div class="order-number">
                    <strong>{{ $order->order_no }}</strong>
                    <small class="text-muted ms-2">
                        {{ $order->created_at->format('h:i A') }}
                    </small>
                </div>
                <div class="order-status">
                    @php
                    $statusColors = [
                    'pending' => ['bg' => 'warning', 'text' => 'warning'],
                    'confirmed' => ['bg' => 'primary', 'text' => 'primary'],
                    'preparing' => ['bg' => 'info', 'text' => 'info'],
                    'ready' => ['bg' => 'success', 'text' => 'success'],
                    'delivered' => ['bg' => 'dark', 'text' => 'dark'],
                    'cancelled' => ['bg' => 'danger', 'text' => 'danger'],
                    'paid' => ['bg' => 'purple', 'text' => 'purple']
                    ];
                    $status = $order->status;
                    $color = $statusColors[$status] ?? ['bg' => 'secondary', 'text' => 'secondary'];
                    @endphp
                    <span class="badge bg-{{ $color['bg'] }} bg-opacity-10 text-{{ $color['text'] }} border border-{{ $color['text'] }} border-opacity-25">
                        {{ ucfirst($status) }}
                    </span>
                </div>
            </div>
            <div class="order-details">
                <div class="customer-info">
                    <i class="fas fa-user me-2 text-muted"></i>
                    <span>{{ $order->customer->name ?? 'Walk-in Customer' }}</span>
                </div>
                <div class="order-items">
                    <i class="fas fa-utensils me-2 text-muted"></i>
                    <span>{{ $order->items_count ?? 0 }} items</span>
                </div>
                <div class="order-amount">
                    <i class="fas fa-dollar-sign me-2 text-muted"></i>
                    <strong class="text-dark">৳{{ number_format($order->total, 2) }}</strong>
                </div>
            </div>
            <div class="order-actions mt-2">
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-eye me-1"></i>View
                </a>
                @if($order->status == 'pending')
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-success ms-2">
                    <i class="fas fa-check me-1"></i>Confirm
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
</div>
</div>

<!-- Right Column: Quick Stats & System Status -->
<div class="dashboard-right">
    <!-- Quick Stats Card -->
    <div class="quick-stats-card mb-4">
        <div class="card-header">
            <h5><i class="fas fa-chart-pie me-2"></i>Quick Stats</h5>
        </div>
        <div class="card-body">
            <div class="quick-stats-list">
                <div class="stat-item">
                    <div class="stat-icon-small bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div>
                        <span class="stat-item-label">This Week</span>
                        <span class="stat-item-value">{{ $thisWeekOrders }}</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-small bg-success bg-opacity-10 text-success">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div>
                        <span class="stat-item-label">Completion Rate</span>
                        <span class="stat-item-value">{{ $completionRate }}%</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-small bg-info bg-opacity-10 text-info">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <span class="stat-item-label">Avg. Processing Time</span>
                        <span class="stat-item-value">15m</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-small bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div>
                        <span class="stat-item-label">Peak Hours</span>
                        <span class="stat-item-value">12-2 PM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Status Card -->
    <div class="system-status-card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-server me-2 text-success"></i>
                System Status
            </h5>
        </div>
        <div class="card-body">
            <div class="system-status-list">
                <div class="status-item">
                    <div class="status-indicator bg-success"></div>
                    <span>Order Processing</span>
                    <span class="text-success ms-auto">Online</span>
                </div>
                <div class="status-item">
                    <div class="status-indicator bg-success"></div>
                    <span>Payment Gateway</span>
                    <span class="text-success ms-auto">Active</span>
                </div>
                <div class="status-item">
                    <div class="status-indicator bg-success"></div>
                    <span>Database Connection</span>
                    <span class="text-success ms-auto">Stable</span>
                </div>
                <div class="status-item">
                    <div class="status-indicator bg-warning"></div>
                    <span>Inventory Sync</span>
                    <span class="text-warning ms-auto">Syncing</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div> --}}
</div>

<style>
    /* ============================
   DASHBOARD VARIABLES & THEME
============================ */
    :root {
        --coral-primary: #FF7F50;
        --coral-light: rgba(255, 127, 80, 0.1);
        --coral-hover: #E86B40;
        --text-dark: #2c3e50;
        --text-muted: #95a5a6;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --card-radius: 20px;
    }

    /* Global Overrides */
    .text-primary {
        color: var(--coral-primary) !important;
    }

    .bg-primary {
        background-color: var(--coral-primary) !important;
    }

    .bg-primary-light {
        background-color: var(--coral-light) !important;
    }

    /* Dashboard Container */
    .dashboard-container {
        padding: 30px;
        min-height: 100vh;
        background: #fdfdfd;
        /* Very light background */
        font-family: 'Poppins', sans-serif;
    }

    /* Page Title */
    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 400;
    }

    /* Dashboard Header */
    .dashboard-header {
        background: white;
        padding: 25px 30px;
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
        border: 1px solid rgba(0, 0, 0, 0.02);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Button Styling */
    .btn-primary {
        background-color: var(--coral-primary) !important;
        border-color: var(--coral-primary) !important;
        box-shadow: 0 4px 12px rgba(255, 127, 80, 0.3);
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--coral-hover) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(255, 127, 80, 0.4);
    }

    .btn-outline-primary {
        color: var(--coral-primary) !important;
        border-color: var(--coral-primary) !important;
        border-radius: 10px;
    }

    .btn-outline-primary:hover {
        background-color: var(--coral-primary) !important;
        color: white !important;
    }

    /* Statistics Cards */
    .stat-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 25px;
        box-shadow: var(--card-shadow);
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
        z-index: 1;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
        border-radius: 0 0 0 100%;
        z-index: -1;
    }

    /* Stat Colors & Gradients */
    .stat-primary .stat-icon {
        background: rgba(255, 127, 80, 0.1);
        color: #FF7F50;
    }

    .stat-success .stat-icon {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
    }

    .stat-info .stat-icon {
        background: rgba(14, 165, 233, 0.1);
        color: #0EA5E9;
    }

    .stat-warning .stat-icon {
        background: rgba(245, 158, 11, 0.1);
        color: #F59E0B;
    }

    .stat-danger .stat-icon {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
    }

    .stat-purple .stat-icon {
        background: rgba(139, 92, 246, 0.1);
        color: #8B5CF6;
    }

    .stat-primary .progress-bar {
        background-color: #FF7F50 !important;
    }

    .stat-success .progress-bar {
        background-color: #10B981 !important;
    }

    .stat-info .progress-bar {
        background-color: #0EA5E9 !important;
    }

    .stat-warning .progress-bar {
        background-color: #F59E0B !important;
    }

    .stat-danger .progress-bar {
        background-color: #EF4444 !important;
    }

    .stat-purple .progress-bar {
        background-color: #8B5CF6 !important;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--text-dark);
        letter-spacing: -1px;
    }

    .stat-label {
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 15px;
    }

    .stat-trend {
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 20px;
        background: #f8fafc;
        color: var(--text-muted);
    }

    .stat-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(0, 0, 0, 0.02);
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    /* Recent Orders Card */
    .recent-orders-card {
        background: white;
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
    }

    .recent-orders-card .card-header {
        background: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        padding: 25px;
    }

    .recent-orders-card .card-header h5 {
        font-weight: 600;
        color: var(--text-dark);
    }

    .order-item {
        padding: 20px 25px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        transition: background 0.2s;
        cursor: pointer;
    }

    .order-item:hover {
        background: #fff9f6;
        /* Very light coral tint */
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-number strong {
        color: var(--coral-primary);
        font-weight: 600;
    }

    /* Quick Stats & System Status */
    .quick-stats-card,
    .system-status-card {
        background: white;
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        border: none;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .quick-stats-card .card-header,
    .system-status-card .card-header {
        background: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        padding: 20px 25px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .stat-item {
        padding: 15px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
    }

    .stat-icon-small {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }

        .stat-value {
            font-size: 26px;
        }

        .dashboard-header {
            flex-direction: column;
            gap: 15px;
        }

        .dashboard-header .quick-actions {
            width: 100%;
        }

        .dashboard-header .btn {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats cards on load
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Auto-refresh recent orders every 30 seconds (optional)
        setInterval(() => {
            // You can add AJAX refresh here if needed
        }, 30000);

        // Add click animation to order items
        const orderItems = document.querySelectorAll('.order-item');
        orderItems.forEach(item => {
            item.addEventListener('click', function(e) {
                if (!e.target.closest('.btn')) {
                    const viewBtn = this.querySelector('.btn-outline-secondary');
                    if (viewBtn) {
                        window.location.href = viewBtn.href;
                    }
                }
            });
        });
    });
</script>

@endsection
