<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'brand',
        'food_name',
        'food_type',
        'size',
        'barcode_number',
    ];

    public function nutritionFact()
    {
        return $this->hasOne(NutritionFact::class);
    }

    public function dailyNutrition()
    {
        return $this->belongsToMany(DailyNutrition::class);
    }
}
