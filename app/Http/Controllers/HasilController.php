<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPerhitungan;
use App\Models\Kriteria;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilController extends Controller
{
    public function index()
    {
        $hasils = HasilPerhitungan::with('alternatif')
            ->orderBy('ranking', 'asc')
            ->get();
        
        $kriterias = Kriteria::all();
        
        return view('hasil.index', compact('hasils', 'kriterias'));
    }

    public function destroy($id)
    {
        try {
            HasilPerhitungan::findOrFail($id)->delete();
            
            // Update ranking setelah delete
            $hasils = HasilPerhitungan::orderBy('nilai_akhir', 'desc')->get();
            $ranking = 1;
            foreach ($hasils as $hasil) {
                $hasil->ranking = $ranking;
                $hasil->save();
                $ranking++;
            }
            
            Alert::success('Berhasil', 'Data hasil perhitungan berhasil dihapus');
            return redirect()->route('hasil.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }

    public function exportPDF()
    {
        $hasils = HasilPerhitungan::with('alternatif')
            ->orderBy('ranking', 'asc')
            ->get();
        
        $kriterias = Kriteria::all();
        
        $pdf = Pdf::loadView('hasil.pdf', compact('hasils', 'kriterias'));
        return $pdf->download('hasil-perhitungan-saw-' . date('Y-m-d') . '.pdf');
    }
}
