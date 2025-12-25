@extends('layouts.app')

@section('title', 'Penilaian')
@section('subtitle', 'Edit Penilaian')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Edit Penilaian - {{ $alternatif->nama_barang }}</h6>
            </div>
            <div class="flex-auto px-6 pt-6 pb-6">
                <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Barang</label>
                        <input type="text" 
                               value="{{ $alternatif->kode_alternatif }} - {{ $alternatif->nama_barang }}"
                               disabled
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700">
                    </div>

                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <h6 class="mb-4 text-sm font-bold">Nilai Kriteria</h6>
                        
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
                                   value="{{ old('penilaian.'.$kriteria->id, $penilaians[$kriteria->id] ?? '') }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                   placeholder="Masukkan nilai">
                            @error('penilaian.'.$kriteria->id)
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>

                    <div class="flex gap-2 mt-6">
                        <button type="submit"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            Update
                        </button>
                        <a href="{{ route('penilaian.index') }}"
                           class="inline-block px-6 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
