@extends('layouts.app')

@section('title', 'Penilaian')
@section('subtitle', 'Data Penilaian')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex justify-between items-center">
                    <h6>Tabel Penilaian Alternatif</h6>
                    <a href="{{ route('penilaian.create') }}" 
                       class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-plus"></i> Input Penilaian
                    </a>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Kode
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nama Barang
                                </th>
                                @foreach($kriterias as $kriteria)
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    {{ $kriteria->kode_kriteria }}
                                </th>
                                @endforeach
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alternatifs as $alternatif)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs px-4">{{ $alternatif->kode_alternatif }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $alternatif->nama_barang }}</p>
                                </td>
                                @foreach($kriterias as $kriteria)
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @php
                                        $nilai = $alternatif->penilaian->where('kriteria_id', $kriteria->id)->first();
                                    @endphp
                                    <span class="font-semibold leading-tight text-xs {{ $nilai ? 'text-slate-700' : 'text-red-500' }}">
                                        {{ $nilai ? $nilai->nilai : '-' }}
                                    </span>
                                </td>
                                @endforeach
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="{{ route('penilaian.edit', $alternatif->id) }}" 
                                       class="inline-block px-3 py-2 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ count($kriterias) + 3 }}" class="p-6 text-center">
                                    Belum ada data penilaian
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
<script>
// Attach SweetAlert2 delete handlers for penilaian (same behavior as barang/kriteria)
function attachDeleteHandlers() {
    document.querySelectorAll('.btn-delete').forEach(function(btn){
        btn.addEventListener('click', function(e){
            e.preventDefault();
            const form = btn.closest('form');
            if (typeof Swal === 'undefined') {
                if (confirm('Hapus semua penilaian untuk barang ini?\nData yang dihapus tidak dapat dikembalikan.')) {
                    form.submit();
                }
                return;
            }
            Swal.fire({
                title: 'Hapus penilaian?',
                text: 'Hapus semua penilaian untuk barang ini? Data yang dihapus tidak dapat dikembalikan.',
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
@endsection
