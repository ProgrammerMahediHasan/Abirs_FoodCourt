<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class ProductController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $data = $menus->map(function (Menu $menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'description' => $menu->description,
                'price' => $menu->price,
                'category' => $menu->category->name ?? null,
                'category_name' => $menu->category->name ?? null,
                'image_url' => $menu->image ? asset('storage/' . $menu->image) : null,
                'available' => true,
            ];
        });

        return response()->json($data);
    }
}

