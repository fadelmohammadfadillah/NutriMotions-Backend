<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari request
        $validatedData = $request->validate([
            'brand' => 'nullable|string',
            'food_name' => 'required|string',
            'food_type' => 'required|string',
            'size' => 'required|numeric',
        ]);

        // Membuat data baru
        $food = Food::create($validatedData);

        // Mengembalikan response
        return response()->json([
            'message' => 'Food created successfully',
            'data' => $food
        ], 201);
    }
}
