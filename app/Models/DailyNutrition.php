<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyNutrition extends Model
{
    
    protected $table = 'daily_nutritions';
    protected $fillable = [
        'user_id',
        'tanggal',
        'kalori',
        'karbohidrat',
        'protein',
        'lemak',
        'serat',
        'air',
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class,'daily_nutritions_foods');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
