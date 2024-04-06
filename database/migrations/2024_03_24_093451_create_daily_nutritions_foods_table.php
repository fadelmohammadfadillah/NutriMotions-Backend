<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_nutritions_foods', function (Blueprint $table) {
            $table->foreignId("daily_nutrition_id");
            $table->foreign("daily_nutrition_id")->references("id")->on("daily_nutritions")->onDelete("CASCADE");
            $table->foreignId("food_id");
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("CASCADE");
            $table->time('time_eaten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_nutritions_foods');
    }
};
