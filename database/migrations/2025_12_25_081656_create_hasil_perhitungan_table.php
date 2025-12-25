<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->decimal('nilai_akhir', 10, 4);
            $table->integer('ranking');
            $table->string('status_rekomendasi', 50); // 'Prioritas Tinggi', 'Prioritas Sedang', 'Prioritas Rendah'
            $table->timestamp('tanggal_perhitungan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_perhitungan');
    }
};