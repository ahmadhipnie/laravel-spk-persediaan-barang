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
                                        <a href="{{ route('alternatif.edit', $alternatif->id) }}" class="inline-block px-3 py-2 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft"> <i class="fas fa-edit mr-1"></i> Edit</a>
                                        <form action="{{ route('alternatif.destroy', $alternatif->id) }}" method="POST" class="inline-block delete-form-alt">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete-alt inline-block px-3 py-2 mb-0 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-gradient-to-tl from-red-600 to-rose-400 hover:from-red-700 hover:to-rose-500 active:opacity-85 hover:scale-102 tracking-tight-soft"> <i class="fas fa-trash mr-1"></i> Hapus</button>
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

@push('scripts')
<script>
    (function(){
        function attach() {
            document.querySelectorAll('.btn-delete-alt').forEach(function(btn){
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    const form = btn.closest('form');
                    if (typeof Swal === 'undefined') {
                        if (confirm('Hapus alternatif ini?\nData akan dihapus dan tidak bisa dikembalikan.')) form.submit();
                        return;
                    }
                    Swal.fire({
                        title: 'Hapus alternatif?',
                        text: 'Data akan dihapus dan tidak bisa dikembalikan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then(function(result){ if (result.isConfirmed) form.submit(); });
                });
            });
        }
        function loadAndAttach(){
            if (!window.Swal) {
                var s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                s.defer = true;
                s.onload = attach;
                document.head.appendChild(s);
            } else attach();
        }
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', loadAndAttach);
        else loadAndAttach();
    })();
</script>
@endpush
