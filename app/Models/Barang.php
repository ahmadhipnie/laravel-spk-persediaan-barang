<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    protected $table = 'barang';
    
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'stok_tersedia',
        'stok_minimum',
        'stok_maksimum',
        'harga_satuan',
        'satuan',
        'lead_time',
        'frekuensi_pemakaian',
        'keterangan'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'stok_tersedia' => 'integer',
        'stok_minimum' => 'integer',
        'stok_maksimum' => 'integer',
        'lead_time' => 'integer',
        'frekuensi_pemakaian' => 'integer',
    ];

    // Relasi ke Alternatif
    public function alternatif(): HasMany
    {
        return $this->hasMany(Alternatif::class);
    }
    
    // Helper method untuk cek stok kritis
    public function isStokKritis(): bool
    {
        return $this->stok_tersedia <= $this->stok_minimum;
    }
}
