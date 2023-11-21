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
        Schema::create('food_trucks', function (Blueprint $table) {
            $table->id();
            $table->string('food_truck_img')->comment('フードトラック画像');
            $table->longText('food_truck_text')->comment('フードトラックマークダウン');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_trucks');
    }
};
