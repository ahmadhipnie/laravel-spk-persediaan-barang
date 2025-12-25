<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria', 10)->unique(); // C1, C2, C3, C4
            $table->string('nama_kriteria', 100); // Harga, Permintaan, dll
            $table->enum('atribut', ['benefit', 'cost']); // Tipe kriteria
            $table->decimal('bobot', 5, 2); // Bobot kriteria (0.00 - 1.00)
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};