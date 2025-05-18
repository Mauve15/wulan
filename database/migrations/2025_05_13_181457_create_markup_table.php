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
        Schema::create('markup', function (Blueprint $table) {
            $table->id();
            $table->string('nama_markup')->unique();
            $table->float('persentase'); // Persentase markup, misalnya 15 (untuk 15%)
            $table->string('keterangan')->nullable(); // Keterangan tambahan tentang markup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markup');
    }
};
