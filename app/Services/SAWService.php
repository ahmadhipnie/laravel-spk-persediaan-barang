<?php

namespace App\Services;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilPerhitungan;
use Illuminate\Support\Facades\DB;

class SAWService
{
    /**
     * Hitung metode SAW dan simpan hasilnya
     */
    public function hitungSAW()
    {
        try {
            DB::beginTransaction();

            // 1. Ambil semua data yang diperlukan
            $alternatif = Alternatif::with('penilaian.kriteria')->get();
            $kriteria = Kriteria::all();

            if ($alternatif->isEmpty() || $kriteria->isEmpty()) {
                throw new \Exception('Data alternatif atau kriteria tidak tersedia');
            }

            // 2. Normalisasi Matriks
            $matriksNormalisasi = $this->normalisasiMatriks($alternatif, $kriteria);

            // 3. Hitung Nilai Preferensi
            $nilaiPreferensi = $this->hitungNilaiPreferensi($matriksNormalisasi, $kriteria);

            // 4. Ranking dan Simpan Hasil
            $hasil = $this->simpanHasil($nilaiPreferensi);

            DB::commit();

            return [
                'success' => true,
                'data' => $hasil,
                'matriks_normalisasi' => $matriksNormalisasi,
                'nilai_preferensi' => $nilaiPreferensi
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Normalisasi Matriks berdasarkan atribut kriteria
     */
    private function normalisasiMatriks($alternatif, $kriteria)
    {
        $matriks = [];

        foreach ($alternatif as $alt) {
            $matriks[$alt->id] = [
                'kode' => $alt->kode_alternatif,
                'nama' => $alt->nama_barang,
                'nilai_normalisasi' => []
            ];

            foreach ($kriteria as $krit) {
                $nilaiAsli = $alt->penilaian->where('kriteria_id', $krit->id)->first()->nilai ?? 0;
                
                // Cari nilai max/min untuk kriteria ini
                if ($krit->atribut == 'benefit') {
                    $maxNilai = Penilaian::where('kriteria_id', $krit->id)->max('nilai');
                    $nilaiNormal = $maxNilai > 0 ? ($nilaiAsli / $maxNilai) : 0;
                } else { // cost
                    $minNilai = Penilaian::where('kriteria_id', $krit->id)->min('nilai');
                    $nilaiNormal = $nilaiAsli > 0 ? ($minNilai / $nilaiAsli) : 0;
                }

                $matriks[$alt->id]['nilai_normalisasi'][$krit->id] = round($nilaiNormal, 4);
            }
        }

        return $matriks;
    }

    /**
     * Hitung Nilai Preferensi (Vi)
     */
    private function hitungNilaiPreferensi($matriksNormalisasi, $kriteria)
    {
        $nilaiPreferensi = [];

        foreach ($matriksNormalisasi as $altId => $data) {
            $totalNilai = 0;

            foreach ($kriteria as $krit) {
                $nilaiNormal = $data['nilai_normalisasi'][$krit->id];
                $bobot = $krit->bobot;
                $totalNilai += ($nilaiNormal * $bobot);
            }

            $nilaiPreferensi[$altId] = [
                'kode' => $data['kode'],
                'nama' => $data['nama'],
                'nilai_akhir' => round($totalNilai, 4)
            ];
        }

        // Sort berdasarkan nilai akhir (descending)
        uasort($nilaiPreferensi, function($a, $b) {
            return $b['nilai_akhir'] <=> $a['nilai_akhir'];
        });

        return $nilaiPreferensi;
    }

    /**
     * Simpan Hasil Perhitungan ke Database
     */
    private function simpanHasil($nilaiPreferensi)
    {
        // Hapus hasil perhitungan sebelumnya
        HasilPerhitungan::truncate();

        $ranking = 1;
        $hasil = [];

        foreach ($nilaiPreferensi as $altId => $data) {
            $statusRekomendasi = HasilPerhitungan::tentukanStatus($ranking);

            $hasilPerhitungan = HasilPerhitungan::create([
                'alternatif_id' => $altId,
                'nilai_akhir' => $data['nilai_akhir'],
                'ranking' => $ranking,
                'status_rekomendasi' => $statusRekomendasi,
                'tanggal_perhitungan' => now()
            ]);

            $hasil[] = [
                'ranking' => $ranking,
                'kode_alternatif' => $data['kode'],
                'nama_barang' => $data['nama'],
                'nilai_akhir' => $data['nilai_akhir'],
                'status_rekomendasi' => $statusRekomendasi
            ];

            $ranking++;
        }

        return $hasil;
    }

    /**
     * Ambil hasil perhitungan terakhir
     */
    public function getHasilTerakhir()
    {
        return HasilPerhitungan::with('alternatif')
            ->orderBy('ranking', 'asc')
            ->get();
    }
}