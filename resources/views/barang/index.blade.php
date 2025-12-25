@extends('layouts.app')

@section('title', 'Master Data Barang')
@section('subtitle', 'Data Master')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex justify-between items-center">
                    <div>
                        <h6>Master Data Barang</h6>
                        <p class="text-sm text-slate-500">Seluruh data barang di inventory</p>
                    </div>
                    <button onclick="openModal()"
                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </button>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="p-6 pb-0">
                <div class="flex gap-4 flex-wrap">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" id="searchInput" placeholder="Cari barang..."
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none">
                    </div>
                    <select id="kategoriFilter"
                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700">
                        <option value="">Semua Kategori</option>
                        @foreach($barangs->pluck('kategori')->unique()->filter() as $kategori)
                        <option value="{{ $kategori }}">{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500" id="barangTable">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    No
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Kode
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nama Barang
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Kategori
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Stok
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Min/Max
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Harga
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Status
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $index => $item)
                            <tr class="barang-row" data-kategori="{{ $item->kategori }}">
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs px-4">{{ $index + 1 }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->kode_barang }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $item->nama_barang }}</p>
                                    <p class="mb-0 leading-tight text-xxs text-slate-400">{{ $item->satuan }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->kategori)
                                    <span class="inline-block px-2 py-1 text-xxs font-semibold bg-blue-100 text-blue-800 rounded">
                                        {{ $item->kategori }}
                                    </span>
                                    @else
                                    <span class="text-xs text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="inline-block px-3 py-1 text-xs font-bold {{ $item->isStokKritis() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-full">
                                        {{ $item->stok_tersedia }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs">
                                        <span class="text-orange-600 font-semibold">{{ $item->stok_minimum }}</span>
                                        @if($item->stok_maksimum)
                                        / <span class="text-green-600 font-semibold">{{ $item->stok_maksimum }}</span>
                                        @endif
                                    </p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->harga_satuan)
                                    <p class="mb-0 text-xs font-semibold">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    @else
                                    <span class="text-xs text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->isStokKritis())
                                    <span class="inline-flex items-center px-2 py-1 text-xxs font-bold bg-red-100 text-red-800 rounded-full">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Kritis
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-1 text-xxs font-bold bg-green-100 text-green-800 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i> Aman
                                    </span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
    <button onclick='editModal({{ json_encode($item) }})'
        class="inline-block px-3 py-2 mb-0 font-bold text-center uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in hover:scale-105 active:opacity-85 text-white bg-blue-500 hover:bg-blue-600 shadow-md">
        <i class="fas fa-edit"></i>
    </button>
    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="inline-block ml-2">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Hapus data ini?')"
            class="px-3 py-2 mb-0 font-bold text-center uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in hover:scale-105 active:opacity-85 text-white bg-red-500 hover:bg-red-600 shadow-md">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="p-6 text-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-sm text-gray-500">Belum ada data barang</p>
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

<!-- Modal Tambah/Edit -->
<div id="barangModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full" style="z-index: 9999;">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white" style="z-index: 10000;">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle">Tambah Barang</h3>
            <form id="barangForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kode Barang *</label>
                        <input type="text" name="kode_barang" id="kode_barang" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="BRG001">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Barang *</label>
                        <input type="text" name="nama_barang" id="nama_barang" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="Nama barang">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kategori</label>
                        <input type="text" name="kategori" id="kategori"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="ATK, Elektronik, dll">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Satuan *</label>
                        <select name="satuan" id="satuan" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none">
                            <option value="pcs">Pcs</option>
                            <option value="unit">Unit</option>
                            <option value="box">Box</option>
                            <option value="lusin">Lusin</option>
                            <option value="kg">Kg</option>
                            <option value="liter">Liter</option>
                            <option value="rim">Rim</option>
                        </select>
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Stok Tersedia *</label>
                        <input type="number" name="stok_tersedia" id="stok_tersedia" required min="0"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="0">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Stok Minimum *</label>
                        <input type="number" name="stok_minimum" id="stok_minimum" required min="0"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="0">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Stok Maksimum</label>
                        <input type="number" name="stok_maksimum" id="stok_maksimum" min="0"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="0">
                    </div>

                    <div>
                        <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="harga_satuan" min="0" step="0.01"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                            placeholder="0">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none"
                        placeholder="Keterangan barang (opsional)"></textarea>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()"
                        class="inline-block px-6 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Barang';
        document.getElementById('barangForm').action = '{{ route("barang.store") }}';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('kode_barang').value = '';
        document.getElementById('nama_barang').value = '';
        document.getElementById('kategori').value = '';
        document.getElementById('satuan').value = 'pcs';
        document.getElementById('stok_tersedia').value = '';
        document.getElementById('stok_minimum').value = '';
        document.getElementById('stok_maksimum').value = '';
        document.getElementById('harga_satuan').value = '';
        document.getElementById('keterangan').value = '';
        document.getElementById('barangModal').classList.remove('hidden');
    }

    function editModal(item) {
        document.getElementById('modalTitle').textContent = 'Edit Barang';
        document.getElementById('barangForm').action = '/barang/' + item.id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('kode_barang').value = item.kode_barang;
        document.getElementById('nama_barang').value = item.nama_barang;
        document.getElementById('kategori').value = item.kategori || '';
        document.getElementById('satuan').value = item.satuan;
        document.getElementById('stok_tersedia').value = item.stok_tersedia;
        document.getElementById('stok_minimum').value = item.stok_minimum;
        document.getElementById('stok_maksimum').value = item.stok_maksimum || '';
        document.getElementById('harga_satuan').value = item.harga_satuan || '';
        document.getElementById('keterangan').value = item.keterangan || '';
        document.getElementById('barangModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('barangModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('barangModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterTable();
    });

    document.getElementById('kategoriFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const kategoriValue = document.getElementById('kategoriFilter').value.toLowerCase();
        const rows = document.querySelectorAll('.barang-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const kategori = row.getAttribute('data-kategori').toLowerCase();
            
            const matchSearch = text.includes(searchValue);
            const matchKategori = kategoriValue === '' || kategori === kategoriValue;

            if (matchSearch && matchKategori) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
