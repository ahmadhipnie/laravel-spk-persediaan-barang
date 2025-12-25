@extends('layouts.app')
@section('title', 'dashboard admin')
@section('content')

<div class="flex flex-wrap -mx-3">

    <h1>Halaman Alternatif</h1>

</div>

<div class="mt-4 mb-6">
    <button onclick="openAlternatifModal()" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
        <i class="fas fa-plus"></i> Tambah Alternatif
    </button>
</div>

{{-- Flash Messages --}}
@if(session('success'))
<div class="mb-4 px-4 py-3 text-sm rounded-lg bg-green-50 text-green-700">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="mb-4 px-4 py-3 text-sm rounded-lg bg-red-50 text-red-700">{{ session('error') }}</div>
@endif

<div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Data Alternatif</h6>
            <p class="text-sm text-slate-500">Daftar alternatif (barang pilihan)</p>
        </div>

        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kode</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Barang</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Stok</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Keterangan</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alternatifs as $index => $alternatif)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 font-semibold leading-tight text-xs px-4">{{ $index + 1 }}</p></td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 font-semibold leading-tight text-xs">{{ $alternatif->kode_alternatif }}</p></td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-xs">{{ $alternatif->nama_barang }}</p>
                                @if($alternatif->barang)
                                <p class="mb-0 leading-tight text-xxs text-slate-400">{{ $alternatif->barang->kode_barang ?? '' }}</p>
                                @endif
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><span class="inline-block px-3 py-1 text-xs font-bold {{ $alternatif->stok_tersedia <= 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-full">{{ $alternatif->stok_tersedia }}</span></td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"><p class="mb-0 text-xs">{{ $alternatif->keterangan ?? '-' }}</p></td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <button onclick='editAlternatifModal(@json($alternatif))' class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700"><i class="fas fa-edit text-blue-500"></i></button>

                                <form action="{{ route('alternatif.destroy', $alternatif->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus alternatif ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25"><i class="fas fa-trash text-red-500"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-500">Belum ada data alternatif</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Alternatif -->
<div id="alternatifModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="alternatifModalTitle">Tambah Alternatif</h3>
            <form id="alternatifForm" method="POST" action="{{ route('alternatif.store') }}">
                @csrf
                <input type="hidden" name="_method" id="alternatifFormMethod" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kode Alternatif *</label>
                        <input type="text" name="kode_alternatif" id="kode_alternatif" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="ALT001">
                    </div>

                    <!-- Dropdown pilih barang -->
                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Pilih Barang dari Master *</label>
                        <select name="barang_id" id="barang_id" required onchange="fillBarangData()"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $brg)
                            <option value="{{ $brg->id }}" 
                                    data-kode="{{ $brg->kode_barang }}"
                                    data-nama="{{ $brg->nama_barang }}"
                                    data-stok="{{ $brg->stok_tersedia }}">
                                {{ $brg->kode_barang }} - {{ $brg->nama_barang }} (Stok: {{ $brg->stok_tersedia }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="alt_nama_barang" readonly
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-200 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Stok Tersedia</label>
                        <input type="number" name="stok_tersedia" id="alt_stok_tersedia" readonly min="0"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-200 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Keterangan</label>
                        <textarea name="keterangan" id="alt_keterangan" rows="3"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="Keterangan (opsional)"></textarea>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        Simpan
                    </button>
                    <button type="button" onclick="closeAlternatifModal()"
                        class="inline-block px-6 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAlternatifModal() {
        document.getElementById('alternatifModalTitle').textContent = 'Tambah Alternatif';
        document.getElementById('alternatifForm').action = '{{ route("alternatif.store") }}';
        document.getElementById('alternatifFormMethod').value = 'POST';
        document.getElementById('kode_alternatif').value = '';
        document.getElementById('barang_id').value = '';
        document.getElementById('alt_nama_barang').value = '';
        document.getElementById('alt_stok_tersedia').value = '';
        document.getElementById('alt_keterangan').value = '';
        document.getElementById('alternatifModal').classList.remove('hidden');
    }

    function editAlternatifModal(item) {
        document.getElementById('alternatifModalTitle').textContent = 'Edit Alternatif';
        document.getElementById('alternatifForm').action = '/alternatif/' + item.id;
        document.getElementById('alternatifFormMethod').value = 'PUT';
        document.getElementById('kode_alternatif').value = item.kode_alternatif;
        // try select barang if available
        if (item.barang_id) document.getElementById('barang_id').value = item.barang_id;
        if (item.barang_id) fillBarangData();
        document.getElementById('alt_nama_barang').value = item.nama_barang;
        document.getElementById('alt_stok_tersedia').value = item.stok_tersedia;
        document.getElementById('alt_keterangan').value = item.keterangan || '';
        document.getElementById('alternatifModal').classList.remove('hidden');
    }

    function closeAlternatifModal() {
        document.getElementById('alternatifModal').classList.add('hidden');
    }

    // Fill nama_barang and stok when barang selection changes
    function fillBarangData() {
        const sel = document.getElementById('barang_id');
        const opt = sel.options[sel.selectedIndex];
        if (!opt || !opt.value) {
            document.getElementById('alt_nama_barang').value = '';
            document.getElementById('alt_stok_tersedia').value = '';
            return;
        }
        document.getElementById('alt_nama_barang').value = opt.dataset.nama || '';
        document.getElementById('alt_stok_tersedia').value = opt.dataset.stok || '';
        // Optionally, generate kode based on barang kode
        if (opt.dataset.kode && !document.getElementById('kode_alternatif').value) {
            document.getElementById('kode_alternatif').value = opt.dataset.kode;
        }
    }

    // Close modal when clicking outside
    document.getElementById('alternatifModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAlternatifModal();
        }
    });
</script>

<footer class="pt-4">
    <div class="w-full px-6 mx-auto">
        <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
            <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                    ©
                    <script>
                        document.write(new Date().getFullYear() + ",");
                    </script>
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-semibold text-slate-700"
                        target="_blank">Creative Tim</a>

                    for a better web.
                    <span class="w-full"> Distributed by ❤️ ThemeWagon </span>
                </div>
            </div>
            <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                    <li class="nav-item">
                        <a href="#!"
                            class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-soft-in-out text-slate-500">Creative
                            Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!"
                            class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-soft-in-out text-slate-500">About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!"
                            class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-soft-in-out text-slate-500">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!"
                            class="block px-4 pt-0 pb-1 pr-0 text-sm font-normal transition-colors ease-soft-in-out text-slate-500"
                            target="_blank">License</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

@endsection
