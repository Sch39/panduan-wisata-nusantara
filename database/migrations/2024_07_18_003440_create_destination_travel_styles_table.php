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
        Schema::create('destination_travel_styles', function (Blueprint $table) {
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->foreignId('travel_style_id')->constrained()->cascadeOnDelete();

            $table->primary(['destination_id', 'travel_style_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_travel_styles');
    }
};
