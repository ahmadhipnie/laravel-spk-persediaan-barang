@extends('layouts.app')
@section('title', 'Data Alternatif')
@section('subtitle', 'Master Data')

@section('content')
<div class="w-full p-6">
    <div class="flex flex-wrap -mx-3 px-6">
        <div class="flex-none w-full max-w-full ">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6>Data Alternatif</h6>
                            <p class="text-sm text-slate-500">Daftar alternatif (barang pilihan)</p>
                        </div>
                        <a href="{{ route('alternatif.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs">
                            <i class="fas fa-plus"></i> Tambah Alternatif
                        </a>
                    </div>
                </div>

                @if(session('success'))
                <div class="mx-6 mt-4 px-4 py-3 text-sm rounded-lg bg-green-50 text-green-700">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="mx-6 mt-4 px-4 py-3 text-sm rounded-lg bg-red-50 text-red-700">{{ session('error') }}</div>
                @endif

                <div class="flex-auto p-4">
                    <div class="overflow-x-auto w-full">
                        <table class="items-center w-full min-w-full table-auto mb-0 align-top border-gray-200 text-slate-500 whitespace-normal">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-4 font-bold text-left text-xs text-slate-400">No</th>
                                    <th class="px-6 py-4 font-bold text-left text-xs text-slate-400">Kode</th>
                                    <th class="px-6 py-4 font-bold text-left text-xs text-slate-400">Nama Barang</th>
                                    <th class="px-6 py-4 font-bold text-center text-xs text-slate-400">Stok</th>
                                    <th class="px-6 py-4 font-bold text-left text-xs text-slate-400">Keterangan</th>
                                    <th class="px-6 py-4 font-bold text-center text-xs text-slate-400">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alternatifs as $index => $alternatif)
                                <tr>
                                    <td class="px-6 py-4 align-middle"><p class="mb-0 font-semibold leading-tight text-sm">{{ $index + 1 }}</p></td>
                                    <td class="px-6 py-4 align-middle"><p class="mb-0 font-semibold leading-tight text-sm">{{ $alternatif->kode_alternatif }}</p></td>
                                    <td class="px-6 py-4 align-middle">
                                        <p class="mb-0 font-semibold leading-tight text-sm">{{ $alternatif->nama_barang }}</p>
                                        @if($alternatif->barang)
                                        <p class="mb-0 leading-tight text-xs text-slate-400">{{ $alternatif->barang->kode_barang ?? '' }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center align-middle"><span class="inline-block px-3 py-1 text-sm font-bold {{ $alternatif->stok_tersedia <= 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-full">{{ $alternatif->stok_tersedia }}</span></td>
                                    <td class="px-6 py-4 align-middle"><p class="mb-0 text-sm">{{ $alternatif->keterangan ?? '-' }}</p></td>
                                    <td class="px-6 py-4 text-center align-middle">
                                        <a href="{{ route('alternatif.edit', $alternatif->id) }}" class="inline-flex items-center gap-2 px-3 py-2 mr-2 font-semibold text-sm text-white bg-blue-500 hover:bg-blue-600 rounded"> <i class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ route('alternatif.destroy', $alternatif->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus alternatif ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 font-semibold text-sm text-white bg-red-500 hover:bg-red-600 rounded"> <i class="fas fa-trash"></i> Hapus</button>
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
                        <input type="text" name="kode_alternatif" id="kode_alternatif" required class="block w-full rounded-lg border px-3 py-2" placeholder="ALT001">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Pilih Barang dari Master *</label>
                        <select name="barang_id" id="barang_id" required onchange="fillBarangData()" class="block w-full rounded-lg border px-3 py-2">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $brg)
                            <option value="{{ $brg->id }}" data-kode="{{ $brg->kode_barang }}" data-nama="{{ $brg->nama_barang }}" data-stok="{{ $brg->stok_tersedia }}">{{ $brg->kode_barang }} - {{ $brg->nama_barang }} (Stok: {{ $brg->stok_tersedia }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="alt_nama_barang" readonly class="block w-full rounded-lg border bg-gray-100 px-3 py-2">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Stok Tersedia</label>
                        <input type="number" name="stok_tersedia" id="alt_stok_tersedia" readonly min="0" class="block w-full rounded-lg border bg-gray-100 px-3 py-2">
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Keterangan</label>
                        <textarea name="keterangan" id="alt_keterangan" rows="3" class="block w-full rounded-lg border px-3 py-2" placeholder="Keterangan (opsional)"></textarea>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit" class="px-6 py-3 font-bold text-white bg-gray-800 rounded">Simpan</button>
                    <button type="button" onclick="closeAlternatifModal()" class="px-6 py-3 font-bold text-slate-700 border rounded">Batal</button>
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
        if (opt.dataset.kode && !document.getElementById('kode_alternatif').value) {
            document.getElementById('kode_alternatif').value = opt.dataset.kode;
        }
    }

    document.getElementById('alternatifModal').addEventListener('click', function(e) {
        if (e.target === this) closeAlternatifModal();
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
