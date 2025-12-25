<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\HasilPerhitungan;
use App\Services\SAWService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $sawService;

    public function __construct(SAWService $sawService)
    {
        $this->sawService = $sawService;
    }

    public function index()
    {
        // Statistik Dashboard
        $totalAlternatif = Alternatif::count();
        $totalKriteria = Kriteria::count();
        $hasilTerakhir = HasilPerhitungan::with('alternatif')
            ->orderBy('tanggal_perhitungan', 'desc')
            ->first();
        
        // Top 5 Rekomendasi
        $topRekomendasi = HasilPerhitungan::with('alternatif')
            ->orderBy('ranking', 'asc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalAlternatif',
            'totalKriteria',
            'hasilTerakhir',
            'topRekomendasi'
        ));
    }

    public function hitungSAW()
    {
        $hasil = $this->sawService->hitungSAW();

        if ($hasil['success']) {
            return redirect()->route('dashboard.index')
                ->with('success', 'Perhitungan SAW berhasil dilakukan!');
        } else {
            return redirect()->route('dashboard.index')
                ->with('error', 'Perhitungan gagal: ' . $hasil['message']);
        }
    }
}