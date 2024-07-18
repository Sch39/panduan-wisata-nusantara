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
        Schema::create('destination_details', function (Blueprint $table) {
            $table->id();
            $table->string('language_code');
            $table->string('title');
            $table->string('image_url');
            $table->text('description');
            $table->longText('html_content');
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->foreignId('regency_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['destination_id', 'language_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_details');
    }
};
