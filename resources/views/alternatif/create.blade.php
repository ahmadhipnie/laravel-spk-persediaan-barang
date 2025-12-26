@extends('layouts.app')

@section('title', 'Tambah Alternatif')
@section('subtitle', 'Data Master')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Form Tambah Alternatif</h6>
            <p class="text-sm text-slate-500">Pilih barang dari master untuk dijadikan alternatif</p>
        </div>
        <div class="flex-auto px-6 pt-6 pb-6">
            <form action="{{ route('alternatif.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Kode Alternatif *</label>
                        <input type="text" name="kode_alternatif" required value="{{ old('kode_alternatif') }}"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="ALT001">
                        @error('kode_alternatif')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Pilih Barang *</label>
                        <select name="barang_id" id="barang_id" required onchange="fillBarangData()"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $brg)
                            <option value="{{ $brg->id }}"
                                    data-nama="{{ $brg->nama_barang }}"
                                    data-stok="{{ $brg->stok_tersedia }}"
                                    {{ old('barang_id') == $brg->id ? 'selected' : '' }}>
                                {{ $brg->kode_barang }} - {{ $brg->nama_barang }} (Stok: {{ $brg->stok_tersedia }})
                            </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" readonly
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-200 bg-gray-100 bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all">
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Stok Tersedia</label>
                        <input type="number" name="stok_tersedia" id="stok_tersedia" readonly
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-200 bg-gray-100 bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all">
                    </div>

                    <div class="mb-4 md:col-span-2">
                        <label class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-4 py-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Keterangan (opsional)">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                 <div class="flex gap-2 mt-6 pb-6 mb-4 items-center">
                    <button type="submit"
                        class="inline-block px-8 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-sm ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <a href="{{ route('alternatif.index') }}"
                        class="inline-block mx-2 px-8 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-sm ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function fillBarangData() {
    const select = document.getElementById('barang_id');
    const option = select.options[select.selectedIndex];

    if (option.value) {
        document.getElementById('nama_barang').value = option.getAttribute('data-nama');
        document.getElementById('stok_tersedia').value = option.getAttribute('data-stok');
    } else {
        document.getElementById('nama_barang').value = '';
        document.getElementById('stok_tersedia').value = '';
    }
}
</script>
@endsection
