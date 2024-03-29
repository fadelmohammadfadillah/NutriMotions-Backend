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

    public function food()
    {
        $this->belongsToMany(Food::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
