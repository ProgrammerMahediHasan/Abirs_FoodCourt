<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Auth::routes();

// Home/Dashboard Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected Routes
Route::middleware('auth')->group(function () {

    // Dashboard route
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Inbox Route
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');

    /* ======================
        BASIC RESOURCES
    ======================= */
    Route::resource('categories', CategoryController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stocks', StockController::class);

    /* ======================
        ORDERS (MAIN)
    ======================= */
    Route::prefix('orders')->name('orders.')->group(function () {

        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');

        // ✅ Confirm order
        Route::patch('/{order}/confirm', [OrderController::class, 'confirm'])->name('confirm');

        // ✅ Payment routes
        Route::get('/{order}/payment', [OrderController::class, 'makePaymentForm'])->name('payment.form');
        Route::post('/{order}/payment', [OrderController::class, 'processPayment'])->name('payment.process');

        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');


        Route::get('/orders', [PaymentController::class, 'index'])
            ->name('pages.erp.payments.index');

        // ✅ Invoice
        Route::get('/{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');

        // Optional: Change status
        Route::patch('/{order}/status', [OrderController::class, 'changeStatus'])->name('status');

        // Reports: Delivered Invoices
        Route::get('/reports/delivered', [OrderController::class, 'deliveredReport'])->name('reports.delivered');
    });


    /* ======================
        DASHBOARD APIs
    ======================= */
    Route::get('/api/dashboard/stats', [DashboardController::class, 'getDashboardStats']);
    Route::get('/api/dashboard/today-orders', [DashboardController::class, 'getTodayOrders']);
    Route::get('/api/dashboard/monthly-revenue', [DashboardController::class, 'getMonthlyRevenue']);
    Route::get('/api/dashboard/status-summary', [DashboardController::class, 'getOrderStatusSummary']);
    Route::get('/api/dashboard/recent-activities', [DashboardController::class, 'getRecentActivities']);
    Route::get('/api/dashboard/quick-stats', [DashboardController::class, 'getQuickStats']);

    /* ======================
        REPORTS
    ======================= */
    Route::get('/reports/customer', [OrderController::class, 'customerItemReport'])
        ->name('reports.customer.items');

    /* ======================
        PURCHASES
    ======================= */
    Route::prefix('purchases')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');
        Route::post('/', [PurchaseController::class, 'store'])->name('purchases.store');
        Route::get('/{id}', [PurchaseController::class, 'show'])->name('purchases.show');
        Route::get('/{id}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
        Route::put('/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
        Route::delete('/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');

        Route::post('/{id}/approve', [PurchaseController::class, 'approve'])->name('purchases.approve');
        Route::post('/{id}/receive', [PurchaseController::class, 'receive'])->name('purchases.receive');
        Route::get('/low-stock', [PurchaseController::class, 'lowStock'])->name('purchases.low-stock');
    });

    /* ======================
        SUPPLIERS
    ======================= */
    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    /* ======================
        PRODUCT EXTRA
    ======================= */
    Route::post(
        '/products/{product}/adjust-stock',
        [ProductController::class, 'adjustStock']
    )->name('products.adjust-stock');
});
