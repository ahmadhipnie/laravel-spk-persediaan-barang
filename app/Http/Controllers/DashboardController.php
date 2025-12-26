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

        // Additional stats for dashboard charts
        $totalPerhitungan = HasilPerhitungan::count();

        $highPriority = HasilPerhitungan::where('status_rekomendasi', 'Prioritas Tinggi')->count();
        $mediumPriority = HasilPerhitungan::where('status_rekomendasi', 'Prioritas Sedang')->count();
        $lowPriority = HasilPerhitungan::where('status_rekomendasi', 'Prioritas Rendah')->count();

        // Stock status - langsung dari Barang
        $barang = \App\Models\Barang::all();
        $safeStock = 0;
        $lowStock = 0;
        $criticalStock = 0;

        foreach ($barang as $item) {
            if ($item->stok_tersedia <= 0) {
                $criticalStock++;
            } elseif ($item->stok_tersedia < $item->stok_minimum) {
                $lowStock++;
            } else {
                $safeStock++;
            }
        }

        return view('dashboard.index', compact(
            'totalAlternatif',
            'totalKriteria',
            'hasilTerakhir',
            'topRekomendasi',
            'totalPerhitungan',
            'highPriority',
            'mediumPriority',
            'lowPriority',
            'safeStock',
            'lowStock',
            'criticalStock'
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
