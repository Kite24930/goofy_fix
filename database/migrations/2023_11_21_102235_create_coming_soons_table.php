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
        Schema::create('coming_soons', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('section_item')->comment('SECTION ITEM COMING SOON');
            $table->tinyInteger('school')->comment('SCHOOL COMING SOON');
            $table->tinyInteger('sponsor')->comment('SPONSOR COMING SOON');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coming_soons');
    }
};
