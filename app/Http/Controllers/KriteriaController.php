<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::latest()->get();
        return view('kriteria.index', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|string|max:10|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required|string|max:100',
            'atribut' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Kriteria::create($request->all());
            Alert::success('Berhasil', 'Kriteria berhasil ditambahkan!');
            return redirect()->route('kriteria.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|string|max:10|unique:kriteria,kode_kriteria,' . $id,
            'nama_kriteria' => 'required|string|max:100',
            'atribut' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $kriteria->update($request->all());
            Alert::success('Berhasil', 'Kriteria berhasil diupdate!');
            return redirect()->route('kriteria.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();
            Alert::success('Berhasil', 'Kriteria berhasil dihapus!');
            return redirect()->route('kriteria.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}