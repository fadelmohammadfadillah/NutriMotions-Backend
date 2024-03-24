<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'nutrition_fact_id',
        'brand',
        'food_name',
        'food_type',
        'size',
    ];

    public function nutritionFact()
    {
        return $this->belongsTo(NutritionFact::class);
    }

    public function dailyNutrition()
    {
        return $this->belongsToMany(DailyNutrition::class);
    }
}
