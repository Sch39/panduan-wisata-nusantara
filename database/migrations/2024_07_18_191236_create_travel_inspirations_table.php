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
        Schema::create('travel_inspirations', function (Blueprint $table) {
            $table->id();
            $table->string('language_code');
            $table->string('title');
            $table->string('author');
            $table->string('image_url');
            $table->longText('html_content');
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->foreignId('travel_inspiration_slug_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_inspirations');
    }
};
