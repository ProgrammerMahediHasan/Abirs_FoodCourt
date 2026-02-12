<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show dashboard with statistics
     */
   public function index()
{
    // Debug: লগ করা
    \Log::info('Dashboard Controller called');

    try {
        // Order Statistics
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $totalRevenue = Order::sum('total') ?? 0;
        $todayRevenue = Order::whereDate('created_at', Carbon::today())->sum('total') ?? 0;
        $pendingOrders = Order::where('status', 'pending')->count();
        $avgOrderValue = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;

        // Other Statistics
        $totalCustomers = Customer::count();
        $totalMenus = Menu::count();
        $totalRestaurants = Restaurant::count();

        // Stock Availability (Menu-wise)
        $stockAvailable = Menu::whereHas('stock', function($q){
            $q->where('current_quantity', '>', 0);
        })->count();
        $stockUnavailable = Menu::doesntHave('stock')->count();
        $stockOut = Menu::whereHas('stock', function($q){
            $q->where('current_quantity', '<=', 0);
        })->count();

        // Today's Orders by Status
        $statuses = ['pending','confirmed','preparing','ready','delivered','cancelled'];
        $todayStatusCounts = Order::select('status', DB::raw('COUNT(*) as c'))
            ->whereDate('created_at', Carbon::today())
            ->groupBy('status')
            ->pluck('c', 'status')
            ->toArray();
        $todayOrdersByStatus = [];
        foreach ($statuses as $s) {
            $todayOrdersByStatus[$s] = $todayStatusCounts[$s] ?? 0;
        }

        // Recent Orders (for order management section)
        $recentOrders = Order::with(['customer', 'restaurant'])
                            ->withCount('items')
                            ->latest()
                            ->take(10)
                            ->get();

        // Available Menus
        $availableMenus = Menu::where('status', true)->with(['category', 'stock'])->get();

        // Debug: দেখি ডাটা পাচ্ছি কিনা
        \Log::info('Recent Orders Count: ' . $recentOrders->count());

        // আরো simple করে return করি
        return view('pages.erp.dashboard.dashboard', compact(
            'recentOrders',
            'availableMenus',
            'totalOrders',
            'todayOrders',
            'totalRevenue',
            'todayRevenue',
            'pendingOrders',
            'stockAvailable',
            'stockUnavailable',
            'stockOut',
            'todayOrdersByStatus'
        ));

    } catch (\Exception $e) {
        \Log::error('Dashboard Error: ' . $e->getMessage());
        return view('pages.erp.dashboard.dashboard', [
            'recentOrders' => collect([]),
            'availableMenus' => collect([]),
            'totalOrders' => 0,
            'todayOrders' => 0,
            'totalRevenue' => 0,
            'todayRevenue' => 0,
            'pendingOrders' => 0,
            'stockAvailable' => 0,
            'stockUnavailable' => 0,
            'stockOut' => 0,
            'todayOrdersByStatus' => [
                'pending'=>0,'confirmed'=>0,'preparing'=>0,'ready'=>0,'delivered'=>0,'cancelled'=>0
            ],
        ]);
    }
}
    /**
     * Get weekly revenue data for chart
     */
    private function getWeeklyRevenue()
    {
        try {
            $revenueData = [];
            $now = Carbon::now();

            for ($i = 6; $i >= 0; $i--) {
                $date = $now->copy()->subDays($i);
                $revenue = Order::whereDate('created_at', $date->format('Y-m-d'))->sum('total') ?? 0;

                $revenueData[] = [
                    'date' => $date->format('D'),
                    'revenue' => (float) $revenue,
                    'full_date' => $date->format('Y-m-d')
                ];
            }

            return $revenueData;
        } catch (\Exception $e) {
            \Log::error('Weekly Revenue Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get order status statistics
     */
    private function getOrderStatusStats()
    {
        try {
            $statuses = ['pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled'];
            $stats = [];

            foreach ($statuses as $status) {
                $count = Order::where('status', $status)->count();
                $stats[$status] = $count;
            }

            return $stats;
        } catch (\Exception $e) {
            \Log::error('Order Status Stats Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get popular menus
     */
    private function getPopularMenus($limit = 5)
    {
        try {
            return DB::table('order_items')
                ->join('menus', 'order_items.menu_id', '=', 'menus.id')
                ->select(
                    'menus.id',
                    'menus.name',
                    'menus.price',
                    DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_ordered'),
                    DB::raw('COUNT(DISTINCT order_items.order_id) as order_count')
                )
                ->groupBy('menus.id', 'menus.name', 'menus.price')
                ->orderByDesc('total_ordered')
                ->limit($limit)
                ->get();
        } catch (\Exception $e) {
            \Log::error('Popular Menus Error: ' . $e->getMessage());
            return collect([]);
        }
    }

    /**
     * Get today's orders for dashboard widget
     */
    public function getTodayOrders(Request $request)
    {
        try {
            $orders = Order::whereDate('created_at', Carbon::today())
                ->with(['customer', 'restaurant'])
                ->orderBy('id', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'orders' => $orders,
                'count' => $orders->count()
            ]);
        } catch (\Exception $e) {
            \Log::error('Today Orders Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch today\'s orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get dashboard stats for API
     */
    public function getDashboardStats(Request $request)
    {
        try {
            $totalOrders = Order::count();
            $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
            $totalRevenue = Order::sum('total') ?? 0;
            $todayRevenue = Order::whereDate('created_at', Carbon::today())->sum('total') ?? 0;
            $pendingOrders = Order::where('status', 'pending')->count();

            return response()->json([
                'success' => true,
                'total_orders' => $totalOrders,
                'today_orders' => $todayOrders,
                'total_revenue' => $totalRevenue,
                'today_revenue' => $todayRevenue,
                'pending_orders' => $pendingOrders,
                'avg_order_value' => $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0
            ]);
        } catch (\Exception $e) {
            \Log::error('Dashboard Stats Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch dashboard stats',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get revenue by month (for charts)
     */
    public function getMonthlyRevenue()
    {
        try {
            $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total) as revenue')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

            return response()->json([
                'success' => true,
                'monthly_revenue' => $monthlyRevenue
            ]);
        } catch (\Exception $e) {
            \Log::error('Monthly Revenue Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to fetch monthly revenue'], 500);
        }
    }

    /**
     * Get order status summary for pie chart
     */
    public function getOrderStatusSummary()
    {
        try {
            $statusSummary = Order::select(
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('status')
            ->get()
            ->map(function($item) {
                return [
                    'status' => ucfirst($item->status),
                    'count' => $item->count
                ];
            });

            return response()->json([
                'success' => true,
                'status_summary' => $statusSummary
            ]);
        } catch (\Exception $e) {
            \Log::error('Order Status Summary Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to fetch status summary'], 500);
        }
    }

    /**
     * Get recent activities (last 24 hours)
     */
    public function getRecentActivities()
    {
        try {
            $recentOrders = Order::with(['customer'])
                ->where('created_at', '>=', Carbon::now()->subDay())
                ->orderBy('created_at', 'desc')
                ->take(20)
                ->get()
                ->map(function($order) {
                    return [
                        'id' => $order->id,
                        'order_no' => $order->order_no,
                        'customer_name' => $order->customer->name ?? 'Walk-in Customer',
                        'total' => $order->total,
                        'status' => $order->status,
                        'created_at' => $order->created_at->diffForHumans()
                    ];
                });

            $newCustomers = Customer::where('created_at', '>=', Carbon::now()->subDay())
                ->count();

            return response()->json([
                'success' => true,
                'recent_orders' => $recentOrders,
                'new_customers' => $newCustomers
            ]);
        } catch (\Exception $e) {
            \Log::error('Recent Activities Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to fetch recent activities'], 500);
        }
    }

    /**
     * Get quick statistics
     */
    public function getQuickStats()
    {
        try {
            $stats = [
                'total_orders' => Order::count(),
                'today_orders' => Order::whereDate('created_at', Carbon::today())->count(),
                'total_revenue' => Order::sum('total') ?? 0,
                'today_revenue' => Order::whereDate('created_at', Carbon::today())->sum('total') ?? 0,
                'pending_orders' => Order::where('status', 'pending')->count(),
                'total_customers' => Customer::count(),
                'total_menus' => Menu::count(),
                'active_restaurants' => Restaurant::where('status', 1)->count()
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            \Log::error('Quick Stats Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to fetch quick stats'], 500);
        }
    }
}
