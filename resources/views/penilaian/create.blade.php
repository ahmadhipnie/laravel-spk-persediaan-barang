@extends('layouts.app')

@section('title', 'Penilaian')
@section('subtitle', 'Input Penilaian')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Form Input Penilaian</h6>
            </div>
            <div class="flex-auto px-6 pt-6 pb-6">
                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Pilih Barang</label>
                        <select name="alternatif_id" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($alternatifs as $alt)
                                <option value="{{ $alt->id }}" {{ old('alternatif_id') == $alt->id ? 'selected' : '' }}>
                                    {{ $alt->kode_alternatif }} - {{ $alt->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('alternatif_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <h6 class="mb-4 text-sm font-bold">Input Nilai Kriteria</h6>

                        @foreach($kriterias as $kriteria)
                        <div class="mb-4">
                            <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                {{ $kriteria->nama_kriteria }} ({{ $kriteria->kode_kriteria }})
                                <span class="text-xs font-normal text-slate-500">- {{ ucfirst($kriteria->atribut) }}</span>
                            </label>
                            <input type="number"
                                   name="penilaian[{{ $kriteria->id }}]"
                                   step="0.01"
                                   required
                                   value="{{ old('penilaian.'.$kriteria->id) }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                   placeholder="Masukkan nilai">
                            @error('penilaian.'.$kriteria->id)
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>

                    <div class="flex gap-2 mt-6 pb-6 mb-4 items-center">
                        <button type="submit"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            Simpan
                        </button>
                        <a href="{{ route('penilaian.index') }}"
                           class="inline-block mx-2 px-6 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
