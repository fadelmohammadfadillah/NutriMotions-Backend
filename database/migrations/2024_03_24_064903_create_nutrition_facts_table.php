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
        Schema::create('nutrition_facts', function (Blueprint $table) {
            $table->foreignId("food_id");
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("CASCADE");
            $table->integer('kalori')->nullable();
            $table->decimal('lemak_total', 8, 2)->nullable();
            $table->decimal('lemak_jenuh', 8, 2)->nullable();
            $table->decimal('protein', 8, 2)->nullable();
            $table->decimal('karbohidrat_total', 8, 2)->nullable();
            $table->decimal('gula', 8, 2)->nullable();
            $table->decimal('garam', 8, 2)->nullable();
            $table->decimal('serat', 8, 2)->nullable();
            $table->decimal('vit_a', 8, 2)->nullable();
            $table->decimal('vit_d', 8, 2)->nullable();
            $table->decimal('vit_e', 8, 2)->nullable();
            $table->decimal('vit_k', 8, 2)->nullable();
            $table->decimal('vit_b1', 8, 2)->nullable();
            $table->decimal('vit_b2', 8, 2)->nullable();
            $table->decimal('vit_b3', 8, 2)->nullable();
            $table->decimal('vit_b5', 8, 2)->nullable();
            $table->decimal('vit_b6', 8, 2)->nullable();
            $table->decimal('folat', 8, 2)->nullable();
            $table->decimal('vit_b12', 8, 2)->nullable();
            $table->decimal('biotin', 8, 2)->nullable();
            $table->decimal('kolin', 8, 2)->nullable();
            $table->decimal('vit_c', 8, 2)->nullable();
            $table->decimal('kalsium', 8, 2)->nullable();
            $table->decimal('fosfor', 8, 2)->nullable();
            $table->decimal('magnesium', 8, 2)->nullable();
            $table->decimal('natrium', 8, 2)->nullable();
            $table->decimal('kalium', 8, 2)->nullable();
            $table->decimal('mangan', 8, 2)->nullable();
            $table->decimal('tembaga', 8, 2)->nullable();
            $table->decimal('kromium', 8, 2)->nullable();
            $table->decimal('besi', 8, 2)->nullable();
            $table->decimal('iodium', 8, 2)->nullable();
            $table->decimal('seng', 8, 2)->nullable();
            $table->decimal('selenium', 8, 2)->nullable();
            $table->decimal('fluor', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutritionfacts');
    }
};
