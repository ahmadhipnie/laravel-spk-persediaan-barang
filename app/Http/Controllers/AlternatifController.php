<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    public function index()
    {
    $alternatifs = Alternatif::with('barang')->orderBy('kode_alternatif', 'asc')->get();
    $barangs = Barang::all(); // Untuk dropdown
    return view('alternatif.index', compact('alternatifs', 'barangs'));
}

    public function store(Request $request)
   {
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'kode_alternatif' => 'required|string|max:10|unique:alternatif,kode_alternatif',
        'nama_barang' => 'required|string|max:100',
        'stok_tersedia' => 'required|integer|min:0',
        'keterangan' => 'nullable|string'
    ]);

    try {
        Alternatif::create($request->all());
        Alert::success('Berhasil', 'Data alternatif berhasil ditambahkan');
        return redirect()->route('alternatif.index');
    } catch (\Exception $e) {
        Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        return back()->withInput();
    }
}

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_alternatif' => 'required|string|max:10|unique:alternatif,kode_alternatif,' . $id,
            'barang_id' => 'nullable|exists:barang,id',
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

            $data = $request->only([
                'kode_alternatif',
                'keterangan'
            ]);

            if ($request->filled('barang_id')) {
                $barang = Barang::find($request->barang_id);
                if ($barang) {
                    $data['barang_id'] = $barang->id;
                    $data['nama_barang'] = $barang->nama_barang;
                    $data['stok_tersedia'] = $barang->stok_tersedia;
                }
            } else {
                $data['nama_barang'] = $request->nama_barang;
                $data['stok_tersedia'] = $request->stok_tersedia;
            }

            $alternatif->update($data);

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

            Alert::success('Berhasil', 'Alternatif berhasil diupdate!');
            return redirect()->route('alternatif.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->delete();
            Alert::success('Berhasil', 'Alternatif berhasil dihapus!');
            return redirect()->route('alternatif.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}