<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif;

class AlternatifSeeder extends Seeder
{
    public function run(): void
    {
        $alternatifData = [
            [
                'kode_alternatif' => 'A001',
                'nama_barang' => 'Kertas A4 80gsm',
                'stok_tersedia' => 50,
                'keterangan' => 'Kertas HVS untuk keperluan administrasi kantor'
            ],
            [
                'kode_alternatif' => 'A002',
                'nama_barang' => 'Tinta Printer HP Black',
                'stok_tersedia' => 15,
                'keterangan' => 'Tinta original HP untuk printer kantor'
            ],
            [
                'kode_alternatif' => 'A003',
                'nama_barang' => 'Spidol Whiteboard',
                'stok_tersedia' => 120,
                'keterangan' => 'Spidol untuk papan tulis meeting room'
            ],
            [
                'kode_alternatif' => 'A004',
                'nama_barang' => 'Buku Tulis 50 Lembar',
                'stok_tersedia' => 30,
                'keterangan' => 'Buku tulis untuk training karyawan'
            ],
            [
                'kode_alternatif' => 'A005',
                'nama_barang' => 'Stapler Joyko HD-10D',
                'stok_tersedia' => 8,
                'keterangan' => 'Stapler besar untuk keperluan arsip'
            ],
            [
                'kode_alternatif' => 'A006',
                'nama_barang' => 'Penghapus Whiteboard',
                'stok_tersedia' => 25,
                'keterangan' => 'Penghapus magnetic untuk whiteboard'
            ],
            [
                'kode_alternatif' => 'A007',
                'nama_barang' => 'Amplop Coklat Folio',
                'stok_tersedia' => 200,
                'keterangan' => 'Amplop untuk surat menyurat'
            ],
            [
                'kode_alternatif' => 'A008',
                'nama_barang' => 'Gunting Kertas',
                'stok_tersedia' => 12,
                'keterangan' => 'Gunting stainless steel untuk keperluan umum'
            ],
            [
                'kode_alternatif' => 'A009',
                'nama_barang' => 'Lem Kertas UHU Stick',
                'stok_tersedia' => 40,
                'keterangan' => 'Lem stick untuk keperluan administrasi'
            ],
            [
                'kode_alternatif' => 'A010',
                'nama_barang' => 'Tipe-X Correction Tape',
                'stok_tersedia' => 18,
                'keterangan' => 'Tipe-X model tape untuk koreksi dokumen'
            ],
        ];

        foreach ($alternatifData as $alternatif) {
            Alternatif::create($alternatif);
        }
    }
}
