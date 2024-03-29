<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionFact extends Model
{
    protected $table = 'nutrition_facts';
    protected $fillable = [
        'kalori',
        'lemak_total',
        'lemak_jenuh',
        'protein',
        'karbohidrat_total',
        'gula',
        'garam',
        'serat',
        'vit_a',
        'vit_d',
        'vit_e',
        'vit_k',
        'vit_b1',
        'vit_b2',
        'vit_b3',
        'vit_b5',
        'vit_b6',
        'folat',
        'vit_b12',
        'biotin',
        'kolin',
        'vit_c',
        'kalsium',
        'fosfor',
        'magnesium',
        'natrium',
        'kalium',
        'mangan',
        'tembaga',
        'kromium',
        'besi',
        'iodium',
        'seng',
        'selenium',
        'fluor'
    ];

    public function food()
    {
       /**
         * Belong to Food
         *
         * @return Collection
         *
         **/
        $this->hasOne(Food::class); 
    }
}
