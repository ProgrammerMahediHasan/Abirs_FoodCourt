<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrderItem;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // Purchase Order List
    public function index()
    {
        $purchases = PurchaseOrder::with(['supplier', 'createdBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('pages.erp.purchases.index', compact('purchases'));
    }

    // Create Purchase Order Form
    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        $po_number = PurchaseOrder::generatePONumber();

        return view('pages.erp.purchases.create', compact('suppliers', 'products', 'po_number'));
    }

    // Store Purchase Order
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'supplier_id' => 'required|exists:suppliers,id',
                'order_date' => 'required|date',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|numeric|min:0.01',
                'items.*.unit_price' => 'required|numeric|min:0',
            ]);

            // Create Purchase Order
            $purchase = PurchaseOrder::create([
                'po_number' => PurchaseOrder::generatePONumber(),
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'expected_delivery_date' => $request->expected_delivery_date,
                'status' => 'draft',
                'notes' => $request->notes,
                'created_by' => auth()->id(),
                'subtotal' => 0,
                'grand_total' => 0
            ]);

            // Add Items
            $subtotal = 0;
            foreach ($request->items as $item) {
                $total = $item['quantity'] * $item['unit_price'];
                $subtotal += $total;

                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $total
                ]);
            }

            // Update Purchase Order Totals
            $purchase->update([
                'subtotal' => $subtotal,
                'tax' => $request->tax ?? 0,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'grand_total' => $subtotal + ($request->tax ?? 0) + ($request->shipping ?? 0) - ($request->discount ?? 0)
            ]);

            DB::commit();

            return redirect()->route('purchases.show', $purchase->id)
                ->with('success', 'Purchase order created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating purchase order: ' . $e->getMessage());
        }
    }

    // Show Purchase Order
    public function show($id)
    {
        $purchase = PurchaseOrder::with(['supplier', 'items.product', 'createdBy', 'approvedBy'])
            ->findOrFail($id);

        return view('pages.erp.purchases.show', compact('purchase'));
    }

    // Edit Purchase Order
    public function edit($id)
    {
        $purchase = PurchaseOrder::with('items')->findOrFail($id);

        if ($purchase->status != 'draft') {
            return redirect()->route('purchases.show', $id)
                ->with('error', 'Only draft orders can be edited.');
        }

        $suppliers = Supplier::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();

        return view('pages.erp.purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    // Update Purchase Order
    public function update(Request $request, $id)
    {
        $purchase = PurchaseOrder::findOrFail($id);

        if ($purchase->status != 'draft') {
            return redirect()->route('purchases.show', $id)
                ->with('error', 'Only draft orders can be edited.');
        }

        DB::beginTransaction();

        try {
            $request->validate([
                'supplier_id' => 'required|exists:suppliers,id',
                'order_date' => 'required|date',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|numeric|min:0.01',
                'items.*.unit_price' => 'required|numeric|min:0',
            ]);

            // Update Purchase Order
            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'expected_delivery_date' => $request->expected_delivery_date,
                'notes' => $request->notes
            ]);

            // Delete existing items
            $purchase->items()->delete();

            // Add new items
            $subtotal = 0;
            foreach ($request->items as $item) {
                $total = $item['quantity'] * $item['unit_price'];
                $subtotal += $total;

                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $total
                ]);
            }

            // Update totals
            $purchase->update([
                'subtotal' => $subtotal,
                'tax' => $request->tax ?? 0,
                'discount' => $request->discount ?? 0,
                'shipping' => $request->shipping ?? 0,
                'grand_total' => $subtotal + ($request->tax ?? 0) + ($request->shipping ?? 0) - ($request->discount ?? 0)
            ]);

            DB::commit();

            return redirect()->route('purchases.show', $purchase->id)
                ->with('success', 'Purchase order updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating purchase order: ' . $e->getMessage());
        }
    }

    // Approve Purchase Order
    public function approve($id)
    {
        $purchase = PurchaseOrder::findOrFail($id);

        if ($purchase->status != 'draft') {
            return redirect()->back()->with('error', 'Order cannot be approved.');
        }

        $purchase->update([
            'status' => 'approved',
            'approved_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Purchase order approved!');
    }

    // Receive Purchase Order (Stock In)
    public function receive(Request $request, $id)
    {
        $purchase = PurchaseOrder::with('items')->findOrFail($id);

        if ($purchase->status != 'approved') {
            return redirect()->back()->with('error', 'Only approved orders can be received.');
        }

        DB::beginTransaction();

        try {
            $receivedItems = $request->received_items;
            $allReceived = true;

            foreach ($purchase->items as $item) {
                $receivedQty = $receivedItems[$item->id] ?? 0;

                if ($receivedQty > 0) {
                    // Update received quantity
                    $item->update(['received_quantity' => $receivedQty]);

                    // Update product stock and price
                    $product = $item->product;
                    $product->update([
                        'current_stock' => $product->current_stock + $receivedQty,
                        'last_purchase_price' => $item->unit_price
                    ]);

                    // Create stock transaction
                    StockTransaction::create([
                        'date' => now(),
                        'product_id' => $item->product_id,
                        'reference_type' => 'purchase',
                        'reference_id' => $purchase->id,
                        'type' => 'in',
                        'quantity' => $receivedQty,
                        'unit_cost' => $item->unit_price,
                        'total_cost' => $receivedQty * $item->unit_price,
                        'notes' => 'Purchase receipt - PO: ' . $purchase->po_number,
                        'created_by' => auth()->id()
                    ]);
                }

                if ($receivedQty < $item->quantity) {
                    $allReceived = false;
                }
            }

            // Update purchase order status
            $purchase->update([
                'status' => $allReceived ? 'received' : 'approved',
                'delivery_date' => now()
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Purchase items received successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error receiving items: ' . $e->getMessage());
        }
    }

    // Delete Purchase Order
    public function destroy($id)
    {
        $purchase = PurchaseOrder::findOrFail($id);

        if ($purchase->status != 'draft') {
            return redirect()->back()->with('error', 'Only draft orders can be deleted.');
        }

        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase order deleted successfully!');
    }

    // Get Low Stock Products (for purchase suggestion)
    public function lowStock()
    {
        $products = Product::whereColumn('current_stock', '<=', 'reorder_level')
            ->where('is_active', true)
            ->with('supplier')
            ->get();

        return view('pages.erp.purchases.low-stock', compact('products'));
    }
}