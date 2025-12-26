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

        // Stock status (join with barang for stok_minimum)
        $safeStock = Alternatif::join('barang', 'alternatif.barang_id', '=', 'barang.id')
            ->whereColumn('alternatif.stok_tersedia', '>=', 'barang.stok_minimum')
            ->count();
        $lowStock = Alternatif::join('barang', 'alternatif.barang_id', '=', 'barang.id')
            ->whereColumn('alternatif.stok_tersedia', '<', 'barang.stok_minimum')
            ->count();
        $criticalStock = Alternatif::where('stok_tersedia', '<=', 0)->count();

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
