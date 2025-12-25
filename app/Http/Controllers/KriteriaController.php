<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan!');
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

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus!');
    }
}