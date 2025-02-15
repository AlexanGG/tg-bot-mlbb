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
        Schema::create('build_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('build_id')->constrained('builds')->onDelete('cascade');
            $table->string('type'); // item, emblem, spell
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('build_items');
    }
};
