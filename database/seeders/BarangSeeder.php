<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangData = [
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Kertas A4 80gsm',
                'kategori' => 'ATK',
                'stok_tersedia' => 50,
                'stok_minimum' => 100,
                'stok_maksimum' => 500,
                'harga_satuan' => 45000,
                'satuan' => 'rim',
                'lead_time' => 3,
                'frekuensi_pemakaian' => 80,
                'keterangan' => 'Kertas HVS ukuran A4'
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Tinta Printer HP',
                'kategori' => 'ATK',
                'stok_tersedia' => 15,
                'stok_minimum' => 20,
                'stok_maksimum' => 100,
                'harga_satuan' => 250000,
                'satuan' => 'pcs',
                'lead_time' => 5,
                'frekuensi_pemakaian' => 25,
                'keterangan' => 'Tinta original HP Black'
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Spidol Whiteboard',
                'kategori' => 'ATK',
                'stok_tersedia' => 120,
                'stok_minimum' => 50,
                'stok_maksimum' => 200,
                'harga_satuan' => 8000,
                'satuan' => 'pcs',
                'lead_time' => 2,
                'frekuensi_pemakaian' => 40,
                'keterangan' => 'Spidol warna hitam'
            ],
        ];

        foreach ($barangData as $barang) {
            Barang::create($barang);
        }
    }
}
