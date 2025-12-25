<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 100);
            $table->string('kategori', 50)->nullable();
            $table->integer('stok_tersedia')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->integer('stok_maksimum')->nullable();
            $table->decimal('harga_satuan', 12, 2)->nullable();
            $table->string('satuan', 20)->default('pcs');
            $table->integer('lead_time')->nullable()->comment('Waktu tunggu pengadaan dalam hari');
            $table->integer('frekuensi_pemakaian')->default(0)->comment('Jumlah pemakaian per bulan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
