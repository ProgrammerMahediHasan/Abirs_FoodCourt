<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Menu;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('menu')->paginate(10);
        return view('pages.erp.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('pages.erp.stocks.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id|unique:stocks,menu_id',
            'current_quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
    }

    public function edit(Stock $stock)
    {
        $menus = Menu::all();
        return view('pages.erp.stocks.edit', compact('stock', 'menus'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id|unique:stocks,menu_id,' . $stock->id,
            'current_quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }
}