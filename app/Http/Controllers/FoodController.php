<?php

namespace App\Http\Controllers;

use App\Http\Resources\Food\FoodCollection;
use App\Models\Food;
use App\Service\ResponseAPIService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{


    public function store(Request $request)
    {
        // Validasi input dari request, termasuk validasi untuk file gambar
        $validatedData = $request->validate([
            'brand' => 'nullable|string',
            'food_name' => 'required|string',
            'food_type' => 'required|string',
            'size' => 'required|numeric',
            'barcode_number' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('picture')) {
            $photo = $request->file('picture');

            // Simpan foto ke dalam penyimpanan dengan nama file yang unik
            $path = Storage::putFile('public/food', $photo);

            // Dapatkan URL lengkap untuk gambar yang disimpan
            $url = Storage::url($path);


            // Simpan URL gambar ke dalam data yang akan disimpan
            $validatedData['picture'] = $url;
        }

        // Membuat data baru dengan gambar jika ada
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
                "id"=> $food->id,
                "brand" => $food->brand,
                "food_name" => $food->food_name,
                "picture" => $food->picture,
                "food_type"=>$food->food_type,
                "size"=>$food->size,
                "barcode_number"=>$food->barcode_number,
                    "kalori" =>$food->nutritionFact->kalori,
                    "lemak_total" =>$food->nutritionFact->lemak_total,
                    "lemak_jenuh" =>$food->nutritionFact->lemak_jenuh,
                    "protein" =>$food->nutritionFact->protein,
                    "karbohidrat_total" =>$food->nutritionFact->karbohidrat_total,
                    "gula" =>$food->nutritionFact->gula,
                    "garam" =>$food->nutritionFact->garam,
                    "serat" =>$food->nutritionFact->serat,
                    "vit_a" =>$food->nutritionFact->vit_a,
                    "vit_d" =>$food->nutritionFact->vit_d,
                    "vit_e" =>$food->nutritionFact->vit_e,
                    "vit_k" =>$food->nutritionFact->vit_k,
                    "vit_b1" =>$food->nutritionFact->vit_b1,
                    "vit_b2" =>$food->nutritionFact->vit_b2,
                    "vit_b3" =>$food->nutritionFact->vit_b3,
                    "vit_b5" =>$food->nutritionFact->vit_b5,
                    "vit_b6" =>$food->nutritionFact->vit_b6,
                    "folat" =>$food->nutritionFact->folat,
                    "vit_b12" =>$food->nutritionFact->vit_b12,
                    "biotin" =>$food->nutritionFact->biotin,
                    "kolin" =>$food->nutritionFact->kolin,
                    "vit_c" =>$food->nutritionFact->vit_c,
                    "kalsium" =>$food->nutritionFact->kalsium,
                    "fosfor" =>$food->nutritionFact->fosfor,
                    "magnesium" =>$food->nutritionFact->magnesium,
                    "natrium" =>$food->nutritionFact->natrium,
                    "kalium" =>$food->nutritionFact->kalium,
                    "mangan" =>$food->nutritionFact->mangan,
                    "tembaga" =>$food->nutritionFact->tembaga,
                    "kromium" =>$food->nutritionFact->kromium,
                    "besi" =>$food->nutritionFact->besi,
                    "iodium" =>$food->nutritionFact->iodium,
                    "seng" =>$food->nutritionFact->seng,
                    "selenium" =>$food->nutritionFact->selenium,
                    "fluor" =>$food->nutritionFact->fluor
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
