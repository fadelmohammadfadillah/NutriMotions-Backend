<?php

namespace App\Http\Controllers;

use App\Models\DailyNutrition;
use App\Models\Food;
use Illuminate\Http\Request;

class DailyNutritionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'kalori' => 'nullable|integer',
            'karbohidrat' => 'nullable|numeric',
            'protein' => 'nullable|numeric',
            'lemak' => 'nullable|numeric',
            'serat' => 'nullable|numeric',
            'air' => 'nullable|numeric',
        ]);

        // Buat instance baru dari model DailyNutrition
        $dailyNutrition = new DailyNutrition();

        // Isi kolom-kolom dalam instance DailyNutrition dengan data dari request
        $dailyNutrition->user_id = $request->user_id;
        $dailyNutrition->tanggal = $request->tanggal;
        $dailyNutrition->kalori = $request->kalori;
        $dailyNutrition->karbohidrat = $request->karbohidrat;
        $dailyNutrition->protein = $request->protein;
        $dailyNutrition->lemak = $request->lemak;
        $dailyNutrition->serat = $request->serat;
        $dailyNutrition->air = $request->air;

        // Simpan data ke dalam database
        $dailyNutrition->save();

        // Jika berhasil, kembalikan respons dengan data yang baru disimpan
        return response()->json(['message' => 'DailyNutrition created successfully', 'data' => $dailyNutrition], 201);
    }

    public function findByUserId($userId)
    {
        $dailyNutrition = DailyNutrition::where('user_id',$userId)->get();
        if(!$dailyNutrition->isEmpty()){
            return response()->json([
                'data' => $dailyNutrition,
                'response' => 200
            ]);
        }else{
            return response()->json([
                'data' => 'daily nutrition not found!',
                'response' => 404
            ]);
        }
    }

    public function attachDailyNutFood(Request $request)
    {
        $dailyNut = DailyNutrition::find($request->daily_nutrition_id);
        $food = Food::find($request->food_id);
        if (!$dailyNut || !$food){
            return response()->json(['message' => 'Daily nutrition or food not found'], 404);
        }
        $dailyNut->foods()->attach($request->food_id, ['time_eaten' => $request->time_eaten]);
        return response()->json(['message' => 'Daily nutrition food attached succesfully'], 200);
    }

    // masih error
    public function updateDailyNutByFood($dailyNutId)
    {
        $dailyNut = DailyNutrition::find($dailyNutId);
        if(!$dailyNut){
            return response()->json(['message' => 'Daily nutrition or food not found'], 404);
        }
        $foods = $dailyNut->foods()->get();
        $kalori = 0;
        $karbohidrat = 0;
        $protein = 0;
        $lemak = 0;
        $serat = 0;
        $air = 0;
        foreach ($foods as $food){
            if($food->kalori){
                $kalori = $kalori + $food->kalori;
            }
            if($food->karbohidrat){
                $karbohidrat = $karbohidrat + $food->karbohidrat;
            }
            if($food->protein){
                $protein = $protein + $food->protein;
            }
            if($food->lemak){
                $lemak = $lemak + $food->lemak;
            }
            if($food->serat){
                $serat = $serat + $food->serat;
            }
            if($food->air){
                $air = $air + $food->air;
            }
        }

        $dailyNut->kalori = $kalori;
        $dailyNut->karbohidrat = $karbohidrat;
        $dailyNut->protein = $protein;
        $dailyNut->lemak = $lemak;
        $dailyNut->serat = $serat;
        $dailyNut->air = $air;
        return response()->json([
            'message' => 'Daily nutrition updated by food successfully',
            'data'    => $dailyNut,
            'response'=> 200
        ]);
    }
}
