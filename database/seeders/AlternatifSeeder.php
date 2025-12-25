<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    // Menampilkan daftar alternatif
    public function index()
    {
        $alternatif = Alternatif::with('penilaian.kriteria')
            ->orderBy('kode_alternatif')
            ->get();
        
        $kriteria = Kriteria::orderBy('kode_kriteria')->get();
        
        return view('alternatif.index', compact('alternatif', 'kriteria'));
    }

    // Menyimpan alternatif baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_alternatif' => 'required|unique:alternatif,kode_alternatif',
            'nama_barang' => 'required|max:255',
            'stok_tersedia' => 'required|integer|min:0',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Simpan alternatif
            $alternatif = Alternatif::create($validated);

            // Simpan penilaian untuk setiap kriteria
            $kriteria = Kriteria::all();
            foreach ($kriteria as $krit) {
                $nilaiField = 'nilai_' . $krit->id;
                if ($request->has($nilaiField)) {
                    Penilaian::create([
                        'alternatif_id' => $alternatif->id,
                        'kriteria_id' => $krit->id,
                        'nilai' => $request->input($nilaiField)
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('alternatif.index')
                ->with('success', 'Alternatif berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Gagal menambahkan alternatif: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Update alternatif
    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $validated = $request->validate([
            'kode_alternatif' => 'required|unique:alternatif,kode_alternatif,' . $id,
            'nama_barang' => 'required|max:255',
            'stok_tersedia' => 'required|integer|min:0',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Update alternatif
            $alternatif->update($validated);

            // Update penilaian untuk setiap kriteria
            $kriteria = Kriteria::all();
            foreach ($kriteria as $krit) {
                $nilaiField = 'nilai_' . $krit->id;
                if ($request->has($nilaiField)) {
                    Penilaian::updateOrCreate(
                        [
                            'alternatif_id' => $alternatif->id,
                            'kriteria_id' => $krit->id
                        ],
                        [
                            'nilai' => $request->input($nilaiField)
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->route('alternatif.index')
                ->with('success', 'Alternatif berhasil diupdate!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Gagal mengupdate alternatif: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Hapus alternatif
    public function destroy($id)
    {
        try {
            $alternatif = Alternatif::findOrFail($id);
            
            // Hapus penilaian terkait (cascade delete via model relationship)
            $alternatif->penilaian()->delete();
            
            // Hapus alternatif
            $alternatif->delete();

            return redirect()->route('alternatif.index')
                ->with('success', 'Alternatif berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus alternatif: ' . $e->getMessage());
        }
    }
}