<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable = [
        'kode_alternatif',
        'nama_barang',
        'stok_tersedia',
        'keterangan'
    ];

    protected $casts = [
        'stok_tersedia' => 'integer'
    ];

    // Relasi ke Penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    // Relasi ke Hasil Perhitungan
    public function hasilPerhitungan()
    {
        return $this->hasOne(HasilPerhitungan::class)->latest();
    }

    // Method untuk mendapatkan nilai kriteria tertentu
    public function getNilaiKriteria($kriteriaId)
    {
        return $this->penilaian()->where('kriteria_id', $kriteriaId)->first()->nilai ?? 0;
    }
}