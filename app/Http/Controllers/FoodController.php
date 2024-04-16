<?php

namespace App\Http\Controllers;

use App\Http\Resources\Food\FoodCollection;
use App\Models\Food;
use App\Service\ResponseAPIService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'barcode_number'=>'required',
        ]);

        // Membuat data baru
        $food = Food::create($validatedData);

        // Mengembalikan response
        return response()->json([
            'message' => 'Food created successfully',
            'data' => $food
        ], 201);
    }

    public function show(Request $request){

       $barcode = $request->barcode_number;
        try {
            $food = Food::with('nutritionFact')->where("barcode_number", $barcode)->first();
            return response()->json([
                'food_name'=> $food->food_name,
                'barcode_number' =>$food->barcode_number,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return ResponseAPIService::createResponse(404,"Not Found");
        } catch (\Exception $e) {
            return ResponseAPIService::createResponse(500,"Internal Server Error");
        }

    }

    public function checkfood(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'barcode_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $barcodeExists = Food::where('barcode_number', $request->barcode_number)->exists();
        if ($barcodeExists) {
            $data =  Food::where('barcode_number', $request->barcode_number)->first();
            return response()->json([
                'is_barcode_exist' => $barcodeExists,
                'food_name'=> $data->food_name,
                'barcode_number' =>$data->barcode_number,
            ]);
        }else{
            return response()->json([
                'is_barcode_exist' => $barcodeExists,
                'food_name'=> null,
                'barcode_number'=> null

            ]);
        }

    }
}
