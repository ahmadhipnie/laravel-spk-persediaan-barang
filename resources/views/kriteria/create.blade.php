@extends('layouts.app')

@section('title', 'Tambah Kriteria')
@section('subtitle', 'Data Master')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Form Tambah Kriteria</h6>
            <p class="text-sm text-slate-500">Tambahkan kriteria untuk perhitungan SAW</p>
        </div>
        <div class="flex-auto px-6 pt-6 pb-6">
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Kode Kriteria *</label>
                        <input type="text" name="kode_kriteria" required value="{{ old('kode_kriteria') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="C1">
                        @error('kode_kriteria')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Nama Kriteria *</label>
                        <input type="text" name="nama_kriteria" required value="{{ old('nama_kriteria') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Harga Barang">
                        @error('nama_kriteria')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Atribut *</label>
                        <select name="atribut" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none">
                            <option value="benefit" {{ old('atribut') == 'benefit' ? 'selected' : '' }}>Benefit (Semakin tinggi semakin baik)</option>
                            <option value="cost" {{ old('atribut') == 'cost' ? 'selected' : '' }}>Cost (Semakin rendah semakin baik)</option>
                        </select>
                        @error('atribut')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Bobot (0-1) *</label>
                        <input type="number" name="bobot" required min="0" max="1" step="0.01" value="{{ old('bobot') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="0.25">
                        <p class="text-xs text-slate-500 mt-1">Catatan: Total semua bobot harus = 1</p>
                        @error('bobot')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="inline-block px-8 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-sm ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <a href="{{ route('kriteria.index') }}"
                        class="inline-block px-8 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-sm ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
