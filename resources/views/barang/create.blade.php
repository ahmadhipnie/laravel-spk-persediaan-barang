@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('subtitle', 'Master Data')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Form Tambah Barang</h6>
            <p class="text-sm text-slate-500">Lengkapi data barang di bawah ini</p>
        </div>
        <div class="flex-auto px-6 pt-6 pb-6">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Kode Barang *</label>
                        <input type="text" name="kode_barang" required value="{{ old('kode_barang') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="BRG001">
                        @error('kode_barang')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Nama Barang *</label>
                        <input type="text" name="nama_barang" required value="{{ old('nama_barang') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Nama barang">
                        @error('nama_barang')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Elektronik, Alat Tulis, dll">
                        @error('kategori')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Pcs, Kg, Unit, dll">
                        @error('satuan')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Stok Tersedia *</label>
                        <input type="number" name="stok_tersedia" required min="0" value="{{ old('stok_tersedia', 0) }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        @error('stok_tersedia')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Stok Minimum *</label>
                        <input type="number" name="stok_minimum" required min="0" value="{{ old('stok_minimum', 0) }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        @error('stok_minimum')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Stok Maksimum</label>
                        <input type="number" name="stok_maksimum" min="0" value="{{ old('stok_maksimum') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        @error('stok_maksimum')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Harga Satuan</label>
                        <input type="number" name="harga_satuan" min="0" step="0.01" value="{{ old('harga_satuan') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="0">
                        @error('harga_satuan')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 md:col-span-2">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Deskripsi barang (opsional)">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-2 mt-6 pb-6 mb-4 items-center">
                    <button type="submit"
                        class="inline-block px-8 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-sm ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <a href="{{ route('barang.index') }}"
                        class="inline-block mx-2 px-8 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-sm ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
