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
Schema::create('layanans', function (Blueprint $table) {
    $table->id();
    $table->string('nama_layanan'); // Contoh: Reguler, Ekspres, Superkilat
    $table->integer('harga_per_kg'); // Contoh: 7000, 12000, 25000
    $table->string('estimasi_waktu'); // Contoh: 3-4 hari
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
