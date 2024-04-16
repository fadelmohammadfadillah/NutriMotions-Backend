<?php

namespace App\Http\Resources\Food;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "brand" => $this->brand,
            "food_name" => $this->food_name,
            "food_type"=>$this->food_type,
            "size"=>$this->size,
            "barcode_number"=>$this->barcode_number,
                "kalori" =>$this->nutritionFact->kalori,
                "lemak_total" =>$this->nutritionFact->lemak_total,
                "lemak_jenuh" =>$this->nutritionFact->lemak_jenuh,
                "protein" =>$this->nutritionFact->protein,
                "karbohidrat_total" =>$this->nutritionFact->karbohidrat_total,
                "gula" =>$this->nutritionFact->gula,
                "garam" =>$this->nutritionFact->garam,
                "serat" =>$this->nutritionFact->serat,
                "vit_a" =>$this->nutritionFact->vit_a,
                "vit_d" =>$this->nutritionFact->vit_d,
                "vit_e" =>$this->nutritionFact->vit_e,
                "vit_k" =>$this->nutritionFact->vit_k,
                "vit_b1" =>$this->nutritionFact->vit_b1,
                "vit_b2" =>$this->nutritionFact->vit_b2,
                "vit_b3" =>$this->nutritionFact->vit_b3,
                "vit_b5" =>$this->nutritionFact->vit_b5,
                "vit_b6" =>$this->nutritionFact->vit_b6,
                "folat" =>$this->nutritionFact->folat,
                "vit_b12" =>$this->nutritionFact->vit_b12,
                "biotin" =>$this->nutritionFact->biotin,
                "kolin" =>$this->nutritionFact->kolin,
                "vit_c" =>$this->nutritionFact->vit_c,
                "kalsium" =>$this->nutritionFact->kalsium,
                "fosfor" =>$this->nutritionFact->fosfor,
                "magnesium" =>$this->nutritionFact->magnesium,
                "natrium" =>$this->nutritionFact->natrium,
                "kalium" =>$this->nutritionFact->kalium,
                "mangan" =>$this->nutritionFact->mangan,
                "tembaga" =>$this->nutritionFact->tembaga,
                "kromium" =>$this->nutritionFact->kromium,
                "besi" =>$this->nutritionFact->besi,
                "iodium" =>$this->nutritionFact->iodium,
                "seng" =>$this->nutritionFact->seng,
                "selenium" =>$this->nutritionFact->selenium,
                "fluor" =>$this->nutritionFact->fluor

        ];
    }
}
