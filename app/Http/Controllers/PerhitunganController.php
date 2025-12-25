<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilPerhitungan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::with(['penilaian.kriteria'])->get();
        $kriterias = Kriteria::all();
        
        // Cek apakah semua alternatif sudah dinilai
        $isComplete = true;
        foreach ($alternatifs as $alt) {
            if ($alt->penilaian->count() != $kriterias->count()) {
                $isComplete = false;
                break;
            }
        }
        
        // Data untuk perhitungan SAW
        $matriksKeputusan = [];
        $matriksNormalisasi = [];
        $nilaiPreferensi = [];
        
        if ($isComplete && $alternatifs->count() > 0) {
            // 1. Membuat Matriks Keputusan
            foreach ($alternatifs as $alt) {
                foreach ($kriterias as $krit) {
                    $nilai = $alt->penilaian->where('kriteria_id', $krit->id)->first();
                    $matriksKeputusan[$alt->id][$krit->id] = $nilai ? $nilai->nilai : 0;
                }
            }
            
            // 2. Normalisasi Matriks
            foreach ($kriterias as $krit) {
                $nilaiKriteria = array_column($matriksKeputusan, $krit->id);
                
                if ($krit->atribut == 'benefit') {
                    $maxNilai = max($nilaiKriteria);
                    foreach ($alternatifs as $alt) {
                        $matriksNormalisasi[$alt->id][$krit->id] = $maxNilai > 0 ? $matriksKeputusan[$alt->id][$krit->id] / $maxNilai : 0;
                    }
                } else { // cost
                    $minNilai = min($nilaiKriteria);
                    foreach ($alternatifs as $alt) {
                        $matriksNormalisasi[$alt->id][$krit->id] = $matriksKeputusan[$alt->id][$krit->id] > 0 ? $minNilai / $matriksKeputusan[$alt->id][$krit->id] : 0;
                    }
                }
            }
            
            // 3. Hitung Nilai Preferensi
            foreach ($alternatifs as $alt) {
                $nilaiPreferensi[$alt->id] = 0;
                foreach ($kriterias as $krit) {
                    $nilaiPreferensi[$alt->id] += $matriksNormalisasi[$alt->id][$krit->id] * $krit->bobot;
                }
            }
            
            // Sort by nilai preferensi descending
            arsort($nilaiPreferensi);
        }
        
        return view('perhitungan.index', compact(
            'alternatifs', 
            'kriterias', 
            'matriksKeputusan', 
            'matriksNormalisasi', 
            'nilaiPreferensi',
            'isComplete'
        ));
    }

    public function proses(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $alternatifs = Alternatif::with(['penilaian'])->get();
            $kriterias = Kriteria::all();
            
            // Validasi: Cek apakah semua alternatif sudah dinilai
            foreach ($alternatifs as $alt) {
                if ($alt->penilaian->count() != $kriterias->count()) {
                    Alert::error('Gagal', 'Pastikan semua barang sudah dinilai pada semua kriteria!');
                    return back();
                }
            }
            
            // 1. Membuat Matriks Keputusan
            $matriksKeputusan = [];
            foreach ($alternatifs as $alt) {
                foreach ($kriterias as $krit) {
                    $nilai = $alt->penilaian->where('kriteria_id', $krit->id)->first();
                    $matriksKeputusan[$alt->id][$krit->id] = $nilai ? $nilai->nilai : 0;
                }
            }
            
            // 2. Normalisasi Matriks
            $matriksNormalisasi = [];
            foreach ($kriterias as $krit) {
                $nilaiKriteria = array_column($matriksKeputusan, $krit->id);
                
                if ($krit->atribut == 'benefit') {
                    $maxNilai = max($nilaiKriteria);
                    foreach ($alternatifs as $alt) {
                        $matriksNormalisasi[$alt->id][$krit->id] = $maxNilai > 0 ? $matriksKeputusan[$alt->id][$krit->id] / $maxNilai : 0;
                    }
                } else { // cost
                    $minNilai = min($nilaiKriteria);
                    foreach ($alternatifs as $alt) {
                        $matriksNormalisasi[$alt->id][$krit->id] = $matriksKeputusan[$alt->id][$krit->id] > 0 ? $minNilai / $matriksKeputusan[$alt->id][$krit->id] : 0;
                    }
                }
            }
            
            // 3. Hitung Nilai Preferensi
            $nilaiPreferensi = [];
            foreach ($alternatifs as $alt) {
                $nilaiPreferensi[$alt->id] = 0;
                foreach ($kriterias as $krit) {
                    $nilaiPreferensi[$alt->id] += $matriksNormalisasi[$alt->id][$krit->id] * $krit->bobot;
                }
            }
            
            // Sort by nilai preferensi descending
            arsort($nilaiPreferensi);
            
            // 4. Simpan Hasil Perhitungan
            // Hapus hasil perhitungan sebelumnya
            HasilPerhitungan::truncate();
            
            $ranking = 1;
            foreach ($nilaiPreferensi as $alternatif_id => $nilai) {
                // Tentukan status rekomendasi berdasarkan ranking
                if ($ranking <= 3) {
                    $status = 'Prioritas Tinggi';
                } elseif ($ranking <= 7) {
                    $status = 'Prioritas Sedang';
                } else {
                    $status = 'Prioritas Rendah';
                }
                
                HasilPerhitungan::create([
                    'alternatif_id' => $alternatif_id,
                    'nilai_akhir' => $nilai,
                    'ranking' => $ranking,
                    'status_rekomendasi' => $status,
                    'tanggal_perhitungan' => now()
                ]);
                
                $ranking++;
            }
            
            DB::commit();
            
            Alert::success('Berhasil', 'Perhitungan SAW berhasil diproses!');
            return redirect()->route('hasil.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }
}
