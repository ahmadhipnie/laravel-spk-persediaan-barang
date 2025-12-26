<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Schema;
use App\Models\Alternatif;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('kode_barang', 'asc')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:50',
            'stok_tersedia' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'stok_maksimum' => 'nullable|integer|min:0',
            'harga_satuan' => 'nullable|numeric|min:0',
            'satuan' => 'required|string|max:20',
            'keterangan' => 'nullable|string'
        ], [
            'kode_barang.required' => 'Kode barang harus diisi',
            'kode_barang.unique' => 'Kode barang sudah digunakan',
            'nama_barang.required' => 'Nama barang harus diisi',
            'stok_tersedia.required' => 'Stok tersedia harus diisi',
            'stok_minimum.required' => 'Stok minimum harus diisi',
            'satuan.required' => 'Satuan harus diisi'
        ]);

        try {
            Barang::create($request->all());
            Alert::success('Berhasil', 'Data barang berhasil ditambahkan');
            return redirect()->route('barang.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang,' . $id,
            'nama_barang' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:50',
            'stok_tersedia' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'stok_maksimum' => 'nullable|integer|min:0',
            'harga_satuan' => 'nullable|numeric|min:0',
            'satuan' => 'required|string|max:20',
            'keterangan' => 'nullable|string'
        ]);

        try {
            $barang = Barang::findOrFail($id);
            $barang->update($request->all());
            Alert::success('Berhasil', 'Data barang berhasil diupdate');
            return redirect()->route('barang.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $barang = Barang::findOrFail($id);

            // Cek apakah barang sudah digunakan di alternatif
            // If migration adding barang_id to alternatif hasn't been run yet,
            // referencing the relationship will cause SQL error. Check column first.
            if (Schema::hasColumn('alternatif', 'barang_id')) {
                if ($barang->alternatif()->count() > 0) {
                    Alert::warning('Peringatan', 'Barang ini sudah digunakan sebagai alternatif. Hapus alternatif terlebih dahulu.');
                    return back();
                }
            } else {
                // Fallback: check by matching nama_barang in alternatif (best-effort)
                if (Alternatif::where('nama_barang', $barang->nama_barang)->exists()) {
                    Alert::warning('Peringatan', "Barang ini tampak sudah digunakan di tabel alternatif (cek nama_barang). Pastikan Anda sudah menjalankan migrasi untuk menambah 'barang_id' atau hapus alternatif terkait terlebih dahulu.");
                    return back();
                }
            }

            $barang->delete();
            Alert::success('Berhasil', 'Data barang berhasil dihapus');
            return redirect()->route('barang.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }
}
