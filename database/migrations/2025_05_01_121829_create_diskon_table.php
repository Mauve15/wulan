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
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->string('kode_diskon')->unique(); // Unik agar bisa dipakai sebagai kode referensi
            $table->string('nama_diskon');
            $table->decimal('jumlah_diskon', 8, 2);  // Akurat, bisa menyimpan angka pecahan seperti 10.5%
            $table->enum('satuan_diskon', ['persen', 'nominal']); // persen = %, nominal = dalam rupiah
            $table->text('keterangan_diskon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon');
    }
};
