<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    public function index()
    {
        // Safety: remove any orphan penilaian (references to non-existing alternatif)
        $orphanCount = Penilaian::whereNotIn('alternatif_id', Alternatif::pluck('id'))->count();
        if ($orphanCount > 0) {
            Log::warning("Found {$orphanCount} orphan penilaian records; deleting them to keep data consistent.");
            Penilaian::whereNotIn('alternatif_id', Alternatif::pluck('id'))->delete();
            Alert::warning('Data Diperbaiki', "Ditemukan dan dihapus {$orphanCount} penilaian yang tidak memiliki referensi alternatif.");
        }
        $alternatifs = Alternatif::with(['penilaian.kriteria'])->get();
        $kriterias = Kriteria::all();
        
        return view('penilaian.index', compact('alternatifs', 'kriterias'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        
        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id',
            'penilaian' => 'required|array',
            'penilaian.*' => 'required|numeric|between:0,1'
        ], [
            'penilaian.*.between' => 'Nilai kriteria harus antara 0 dan 1.'
        ]);

        try {
            foreach ($request->penilaian as $kriteria_id => $nilai) {
                Penilaian::updateOrCreate(
                    [
                        'alternatif_id' => $request->alternatif_id,
                        'kriteria_id' => $kriteria_id
                    ],
                    [
                        'nilai' => $nilai
                    ]
                );
            }

            Alert::success('Berhasil', 'Penilaian berhasil disimpan');
            return redirect()->route('penilaian.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::where('alternatif_id', $id)->pluck('nilai', 'kriteria_id');
        
        return view('penilaian.edit', compact('alternatif', 'kriterias', 'penilaians'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penilaian' => 'required|array',
            'penilaian.*' => 'required|numeric|between:0,1'
        ], [
            'penilaian.*.between' => 'Nilai kriteria harus antara 0 dan 1.'
        ]);

        try {
            foreach ($request->penilaian as $kriteria_id => $nilai) {
                Penilaian::updateOrCreate(
                    [
                        'alternatif_id' => $id,
                        'kriteria_id' => $kriteria_id
                    ],
                    [
                        'nilai' => $nilai
                    ]
                );
            }

            Alert::success('Berhasil', 'Penilaian berhasil diupdate');
            return redirect()->route('penilaian.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Penilaian::where('alternatif_id', $id)->delete();
            Alert::success('Berhasil', 'Penilaian berhasil dihapus');
            return redirect()->route('penilaian.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }
}
