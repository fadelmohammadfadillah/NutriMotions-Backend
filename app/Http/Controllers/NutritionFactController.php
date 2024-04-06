<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\NutritionFact;
use Illuminate\Http\Request;

class NutritionFactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari request
        $validatedData = $request->validate([
            'food_id' => 'required',
            'kalori' => 'nullable|integer',
            'lemak_total' => 'nullable|numeric',
            'lemak_jenuh' => 'nullable|numeric',
            'protein' => 'nullable|numeric',
            'karbohidrat_total' => 'nullable|numeric',
            'gula' => 'nullable|numeric',
            'garam' => 'nullable|numeric',
            'serat' => 'nullable|numeric',
            'vit_a' => 'nullable|numeric',
            'vit_d' => 'nullable|numeric',
            'vit_e' => 'nullable|numeric',
            'vit_k' => 'nullable|numeric',
            'vit_b1' => 'nullable|numeric',
            'vit_b2' => 'nullable|numeric',
            'vit_b3' => 'nullable|numeric',
            'vit_b5' => 'nullable|numeric',
            'vit_b6' => 'nullable|numeric',
            'folat' => 'nullable|numeric',
            'vit_b12' => 'nullable|numeric',
            'biotin' => 'nullable|numeric',
            'kolin' => 'nullable|numeric',
            'vit_c' => 'nullable|numeric',
            'kalsium' => 'nullable|numeric',
            'fosfor' => 'nullable|numeric',
            'magnesium' => 'nullable|numeric',
            'natrium' => 'nullable|numeric',
            'kalium' => 'nullable|numeric',
            'mangan' => 'nullable|numeric',
            'tembaga' => 'nullable|numeric',
            'kromium' => 'nullable|numeric',
            'besi' => 'nullable|numeric',
            'iodium' => 'nullable|numeric',
            'seng' => 'nullable|numeric',
            'selenium' => 'nullable|numeric',
            'fluor' => 'nullable|numeric',
        ]);

        // Membuat data baru
        $nutritionFact = NutritionFact::create($validatedData);

        // Mengembalikan response
        return response()->json([
            'message' => 'Nutrition fact created successfully',
            'data' => $nutritionFact
        ], 201);
    }
}
