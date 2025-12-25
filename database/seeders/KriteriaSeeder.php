<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Harga Barang',
                'atribut' => 'cost',
                'bobot' => 0.25
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Permintaan/Demand',
                'atribut' => 'benefit',
                'bobot' => 0.30
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Waktu Pengiriman',
                'atribut' => 'cost',
                'bobot' => 0.20
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Tingkat Urgensi',
                'atribut' => 'benefit',
                'bobot' => 0.25
            ]
        ];

        foreach ($kriteria as $data) {
            Kriteria::create($data);
        }
    }
}