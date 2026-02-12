<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'asc')->paginate(5);
        return view('pages.erp.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('pages.erp.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Customer::create($request->all());

        return redirect()->route('customer.index')
                         ->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('pages.erp.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:customers,email,'.$customer->id,
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $customer->update($request->all());

        return redirect()->route('customer.index')
                         ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')
                         ->with('success', 'Customer deleted successfully.');
    }





}