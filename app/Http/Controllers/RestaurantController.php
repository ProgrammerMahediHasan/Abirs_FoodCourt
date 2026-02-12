<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
   
    public function index()
    {
        // Get all restaurants
        $restaurants = Restaurant::orderBy('id', 'asc')->paginate(5);
        return view('pages.erp.restaurants.index', compact('restaurants'));
    }


    public function create()
    {
        return view('pages.erp.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Create restaurant
        Restaurant::create($request->all());

        return redirect()->route('restaurants.index')
                         ->with('success', 'Restaurant created successfully.');
    }


    public function edit(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('pages.erp.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Update restaurant
        $restaurant->update($request->all());

        return redirect()->route('restaurants.index')
                         ->with('success', 'Restaurant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('restaurants.index')
                         ->with('success', 'Restaurant deleted successfully.');
    }
}