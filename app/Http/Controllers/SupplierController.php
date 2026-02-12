<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->paginate(20);
        return view('pages.erp.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('pages.erp.suppliers.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'payment_terms' => 'nullable|string',
            'supplier_type' => 'required|string|max:50', // এখন required, যেইটা select করবে সেটাই save হবে
            'balance' => 'nullable|numeric',
            'tax_id' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        // Create supplier
        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'payment_terms' => $request->payment_terms,
            'supplier_type' => $request->supplier_type, // selected value
            'balance' => $request->balance ?? 0,
            'tax_id' => $request->tax_id,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully.');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('pages.erp.suppliers.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('pages.erp.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'payment_terms' => 'nullable|string',
            'supplier_type' => 'required|string|max:50',
            'balance' => 'nullable|numeric',
            'tax_id' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'payment_terms' => $request->payment_terms,
            'supplier_type' => $request->supplier_type,
            'balance' => $request->balance ?? 0,
            'tax_id' => $request->tax_id,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::with('products.purchaseOrderItems', 'products.stockTransactions')->findOrFail($id);

        // প্রতিটি product এর related purchase order items এবং stock transactions delete কর
        foreach ($supplier->products as $product) {
            $product->purchaseOrderItems()->delete();
            $product->stockTransactions()->delete();
        }

        // Supplier এর products delete কর
        $supplier->products()->delete();

        // Supplier delete কর
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier and all related products deleted successfully.');
    }
}