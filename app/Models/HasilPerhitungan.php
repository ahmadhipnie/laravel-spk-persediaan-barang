<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPerhitungan extends Model
{
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
        'tanggal_perhitungan' => 'datetime',
    ];

    // Relasi ke Alternatif
    public function alternatif(): BelongsTo
    {
        return $this->belongsTo(Alternatif::class);
    }
}
