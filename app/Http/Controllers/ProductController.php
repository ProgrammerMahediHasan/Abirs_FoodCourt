<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by supplier
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(20)->appends($request->query());

        $suppliers = Supplier::where('is_active', true)->get();
        $categories = Category::all();

        // Statistics
        $totalProducts = Product::count();
        $lowStockCount = Product::whereRaw('current_stock <= reorder_level')
            ->where('current_stock', '>', 0)
            ->where('is_active', true)
            ->count();
        $outOfStockCount = Product::where('current_stock', '<=', 0)
            ->where('is_active', true)
            ->count();
        $totalStockValue = Product::where('is_active', true)
            ->sum(DB::raw('current_stock * last_purchase_price'));

        return view('pages.erp.products.index', compact(
            'products', 'suppliers', 'categories',
            'totalProducts', 'lowStockCount', 'outOfStockCount', 'totalStockValue'
        ));
    }

    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->get();
        $categories = Category::all();
        return view('pages.erp.products.create', compact('suppliers', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|unique:products,code',
            'category_id' => 'nullable|exists:categories,id',
            'unit' => 'required|string|max:20',
            'reorder_level' => 'required|numeric|min:0',
            'last_purchase_price' => 'nullable|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (Auth::check()) {
            $validated['created_by'] = Auth::id();
        }

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::with([
            'supplier',
            'category',
            'stockTransactions' => function($query) {
                $query->orderBy('created_at', 'desc')->limit(50);
            }
        ])->findOrFail($id);

        return view('pages.erp.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::where('is_active', true)->get();
        $categories = Category::all();

        return view('pages.erp.products.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'nullable|unique:products,code,' . $product->id,
        'category_id' => 'nullable|exists:categories,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'unit' => 'required|string|max:20',
        'current_stock' => 'required|numeric|min:0',
        'reorder_level' => 'required|numeric|min:0',
        'last_purchase_price' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean',
    ]);

    // Optional: track updated_by user
    if (Auth::check()) {
        $validated['updated_by'] = Auth::id();
    }

    // Update the product
    $product->update($validated);

    return redirect()->route('products.show', $product->id)
        ->with('success', 'Product updated successfully.');
}


  public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Delete the product directly, ignore related transactions
    $product->delete();

    return redirect()->route('products.index')
        ->with('success', 'Product deleted successfully.');
}


    public function adjustStock(Request $request, $id)
    {
        $request->validate([
            'adjustment_type' => 'required|in:add,remove',
            'quantity' => 'required|numeric|min:0.01',
            'reason' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        DB::beginTransaction();
        try {
            if ($request->adjustment_type == 'add') {
                $product->current_stock += $request->quantity;
            } else {
                if ($product->current_stock < $request->quantity) {
                    return redirect()->back()
                        ->with('error', 'Insufficient stock!');
                }
                $product->current_stock -= $request->quantity;
            }

            $product->save();

            StockTransaction::create([
                'date' => now(),
                'product_id' => $product->id,
                'reference_type' => 'adjustment',
                'reference_id' => 0,
                'type' => $request->adjustment_type == 'add' ? 'in' : 'out',
                'quantity' => $request->quantity,
                'unit_cost' => $product->last_purchase_price,
                'total_cost' => $request->quantity * $product->last_purchase_price,
                'notes' => $request->reason,
                'created_by' => Auth::id()
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Stock adjusted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to adjust stock: ' . $e->getMessage());
        }
    }
}