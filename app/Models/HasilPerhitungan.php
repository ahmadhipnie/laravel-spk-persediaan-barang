<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPerhitungan extends Model
{
    use HasFactory;

    protected $table = 'hasil_perhitungan';

    protected $fillable = [
        'alternatif_id',
        'nilai_akhir',
        'ranking',
        'status_rekomendasi',
        'tanggal_perhitungan'
    ];

    protected $casts = [
        'nilai_akhir' => 'decimal:4',
        'ranking' => 'integer',
        'tanggal_perhitungan' => 'datetime'
    ];

    // Relasi ke Alternatif
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    // Method untuk menentukan status rekomendasi
    public static function tentukanStatus($ranking)
    {
        if ($ranking <= 3) {
            return 'Prioritas Tinggi';
        } elseif ($ranking <= 7) {
            return 'Prioritas Sedang';
        } else {
            return 'Prioritas Rendah';
        }
    }
}