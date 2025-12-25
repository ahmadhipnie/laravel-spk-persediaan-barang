<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kriteria')->insert([
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Harga',
                'atribut' => 'cost', // Semakin rendah semakin baik
                'bobot' => 0.25,
                'keterangan' => 'Harga beli barang dari supplier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Permintaan',
                'atribut' => 'benefit', // Semakin tinggi semakin baik
                'bobot' => 0.30,
                'keterangan' => 'Tingkat permintaan barang dari pelanggan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Waktu Pengiriman',
                'atribut' => 'cost', // Semakin cepat (rendah) semakin baik
                'bobot' => 0.20,
                'keterangan' => 'Waktu pengiriman dari supplier (dalam hari)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Urgensi',
                'atribut' => 'benefit', // Semakin tinggi semakin prioritas
                'bobot' => 0.25,
                'keterangan' => 'Tingkat urgensi kebutuhan barang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}