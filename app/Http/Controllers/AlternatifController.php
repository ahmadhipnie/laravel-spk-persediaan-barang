<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::with('penilaian.kriteria')->latest()->get();
        $kriteria = Kriteria::all();
        
        return view('alternatif.index', compact('alternatif', 'kriteria'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_alternatif' => 'required|string|max:10|unique:alternatif,kode_alternatif',
            'nama_barang' => 'required|string|max:100',
            'stok_tersedia' => 'required|integer|min:0',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $alternatif = Alternatif::create($request->only([
                'kode_alternatif',
                'nama_barang',
                'stok_tersedia',
                'keterangan'
            ]));

            // Buat penilaian untuk setiap kriteria dengan nilai default 0
            $kriteria = Kriteria::all();
            foreach ($kriteria as $krit) {
                Penilaian::create([
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $krit->id,
                    'nilai' => $request->input('nilai_' . $krit->id, 0)
                ]);
            }

            DB::commit();

            return redirect()->route('alternatif.index')
                ->with('success', 'Alternatif berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_alternatif' => 'required|string|max:10|unique:alternatif,kode_alternatif,' . $id,
            'nama_barang' => 'required|string|max:100',
            'stok_tersedia' => 'required|integer|min:0',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $alternatif->update($request->only([
                'kode_alternatif',
                'nama_barang',
                'stok_tersedia',
                'keterangan'
            ]));

            // Update penilaian
            $kriteria = Kriteria::all();
            foreach ($kriteria as $krit) {
                Penilaian::updateOrCreate(
                    [
                        'alternatif_id' => $alternatif->id,
                        'kriteria_id' => $krit->id
                    ],
                    [
                        'nilai' => $request->input('nilai_' . $krit->id, 0)
                    ]
                );
            }

            DB::commit();

            return redirect()->route('alternatif.index')
                ->with('success', 'Alternatif berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif berhasil dihapus!');
    }
}