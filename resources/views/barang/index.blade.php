@extends('layouts.app')

@section('title', 'Master Data Barang')
@section('subtitle', 'Data Master')

@section('content')
<div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <div>
                    <h6>Master Data Barang</h6>
                    <p class="text-sm text-slate-500">Seluruh data barang di inventory</p>
                </div>
                <a href="{{ route('barang.create') }}"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                    <i class="fas fa-plus"></i> Tambah Barang
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="p-4 pb-0">
            <div class="flex flex-wrap">
                <div class="flex-1 gap-2 min-w-[200px]">
                    <input type="text" id="searchInput" placeholder="Cari barang..."
                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none">
                </div>
                <select id="kategoriFilter"
                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 mx-2">
                    <option value="">Semua Kategori</option>
                    @foreach($barangs->pluck('kategori')->unique()->filter() as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
                    <script>
                    // SweetAlert2 for delete confirmation
                    function attachDeleteHandlers() {
                        document.querySelectorAll('.btn-delete').forEach(function(btn){
                            btn.addEventListener('click', function(e){
                                e.preventDefault();
                                const form = btn.closest('form');
                                if (typeof Swal === 'undefined') {
                                    // fallback to native confirm if SweetAlert isn't loaded
                                    if (confirm('Hapus data?\nData akan dihapus dan tidak bisa dikembalikan.')) {
                                        form.submit();
                                    }
                                    return;
                                }
                                Swal.fire({
                                    title: 'Hapus data?',
                                    text: 'Data akan dihapus dan tidak bisa dikembalikan.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#6b7280',
                                    confirmButtonText: 'Ya, hapus',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                });
                            });
                        });
                    }

                    function loadSweetAlertAndAttach() {
                        if (!window.Swal) {
                            var s = document.createElement('script');
                            s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                            s.defer = true;
                            s.onload = attachDeleteHandlers;
                            document.head.appendChild(s);
                        } else {
                            attachDeleteHandlers();
                        }
                    }

                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', loadSweetAlertAndAttach);
                    } else {
                        loadSweetAlertAndAttach();
                    }
                    </script>

        </div>

        <div class="flex-auto p-4">
            <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500" id="barangTable">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                No
                            </th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Kode
                            </th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Nama Barang
                            </th>
                            <th class="px-6 py-4 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Kategori
                            </th>
                            <th class="px-6 py-4 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Stok
                            </th>
                            <th class="px-6 py-4 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Min/Max
                            </th>
                            <th class="px-6 py-4 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Harga
                            </th>
                            <th class="px-6 py-4 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Status
                            </th>
                            <th class="px-6 py-4 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $index => $item)
                        <tr class="barang-row" data-kategori="{{ $item->kategori }}">
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-sm">{{ $index + 1 }}</p>
                            </td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-sm">{{ $item->kode_barang }}</p>
                            </td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-sm">{{ $item->nama_barang }}</p>
                                <p class="mb-0 leading-tight text-xs text-slate-400">{{ $item->satuan }}</p>
                            </td>
                            <td class="px-6 py-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @if($item->kategori)
                                <span class="inline-block px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                                    {{ $item->kategori }}
                                </span>
                                @else
                                <span class="text-sm text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="inline-block px-3 py-1 text-sm font-bold {{ $item->isStokKritis() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-full">
                                    {{ $item->stok_tersedia }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-sm">
                                    <span class="text-orange-600 font-semibold">{{ $item->stok_minimum }}</span>
                                    @if($item->stok_maksimum)
                                    / <span class="text-green-600 font-semibold">{{ $item->stok_maksimum }}</span>
                                    @endif
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @if($item->harga_satuan)
                                <p class="mb-0 text-sm font-semibold">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                @else
                                <span class="text-sm text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @if($item->isStokKritis())
                                <span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-red-100 text-red-800 rounded-full">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Kritis
                                </span>
                                @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full">
                                    <i class="fas fa-check-circle mr-1"></i> Aman
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <a href="{{ route('barang.edit', $item->id) }}"
                                    class="inline-block px-3 py-2 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                        <button type="button" class="btn-delete inline-block px-3 py-2 mb-0 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-gradient-to-tl from-red-600 to-rose-400 hover:from-red-700 hover:to-rose-500 active:opacity-85 hover:scale-102 tracking-tight-soft">
                                            <i class="fas fa-trash mr-1"></i> Hapus
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
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', filterTable);
document.getElementById('kategoriFilter').addEventListener('change', filterTable);

function filterTable() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const kategoriValue = document.getElementById('kategoriFilter').value.toLowerCase();
    const rows = document.querySelectorAll('.barang-row');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const kategori = row.dataset.kategori?.toLowerCase() || '';

        const matchSearch = text.includes(searchValue);
        const matchKategori = !kategoriValue || kategori === kategoriValue;

        if (matchSearch && matchKategori) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>




<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', filterTable);
document.getElementById('kategoriFilter').addEventListener('change', filterTable);

function filterTable() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const kategoriValue = document.getElementById('kategoriFilter').value.toLowerCase();
    const rows = document.querySelectorAll('.barang-row');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const kategori = row.dataset.kategori?.toLowerCase() || '';

        const matchSearch = text.includes(searchValue);
        const matchKategori = !kategoriValue || kategori === kategoriValue;

        if (matchSearch && matchKategori) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>


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
