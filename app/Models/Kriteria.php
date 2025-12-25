<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'atribut',
        'bobot'
    ];

    protected $casts = [
        'bobot' => 'decimal:2'
    ];

    // Relasi ke Penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    // Scope untuk filter berdasarkan atribut
    public function scopeBenefit($query)
    {
        return $query->where('atribut', 'benefit');
    }

    public function scopeCost($query)
    {
        return $query->where('atribut', 'cost');
    }
}