@extends('layouts.app')

@section('title', 'Hasil & Ranking')
@section('subtitle', 'Hasil Perhitungan SAW')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex justify-between items-center">
                    <div>
                        <h6>Hasil Perhitungan & Ranking</h6>
                        <p class="text-sm text-slate-500">Rekomendasi prioritas persediaan barang berdasarkan metode SAW</p>
                    </div>
                    @if($hasils->count() > 0)
                    <div class="flex gap-2">
                        <a href="{{ route('perhitungan.index') }}"
                           class="inline-block mx-2 px-6 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 border-slate-700 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            <i class="fas fa-calculator"></i> Hitung Ulang
                        </a>
                        <a href="{{ route('hasil.export.pdf') }}"
                           class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                    @endif
                </div>
            </div>

         @if($hasils->count() > 0)
    <!-- Statistik Modern -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Prioritas Tinggi -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border-l-4 border-red-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl">
                                <i class="fas fa-fire text-red-600 dark:text-red-400 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Prioritas Tinggi</p>
                                <h4 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                                    {{ $hasils->where('status_rekomendasi', 'Prioritas Tinggi')->count() }}
                                    <span class="text-sm font-normal text-gray-500">item</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Segera restock</span>
                            <div class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300 text-xs font-medium rounded-full">
                                <i class="fas fa-exclamation-circle mr-1"></i> Urgent
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prioritas Sedang -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border-l-4 border-yellow-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl">
                                <i class="fas fa-balance-scale text-yellow-600 dark:text-yellow-400 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Prioritas Sedang</p>
                                <h4 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                                    {{ $hasils->where('status_rekomendasi', 'Prioritas Sedang')->count() }}
                                    <span class="text-sm font-normal text-gray-500">item</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Monitor stok</span>
                            <div class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 text-xs font-medium rounded-full">
                                <i class="fas fa-clock mr-1"></i> Medium
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prioritas Rendah -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300">Prioritas Rendah</p>
                                <h4 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                                    {{ $hasils->where('status_rekomendasi', 'Prioritas Rendah')->count() }}
                                    <span class="text-sm font-normal text-gray-500">item</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Stok aman</span>
                            <div class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs font-medium rounded-full">
                                <i class="fas fa-check mr-1"></i> Stable
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Ranking
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Kode
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nama Barang
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Stok
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nilai Akhir
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Status
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Tanggal
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasils as $hasil)
                            <tr>
                                 <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                     <div class="flex items-center justify-center">
                                         @if($hasil->ranking == 1)
                                        {{-- Show numeric 1 (with crown emoji) to avoid icon rendering issues --}}
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-white font-extrabold text-sm shadow-lg" style="background: linear-gradient(135deg,#b28700 0%,#7f5a00 100%); border:2px solid rgba(255,255,255,0.12);">
                                            <span class="mr-0 text-lg">1</span>
                                            <span class="ml-1 text-base" aria-hidden="true">👑</span>
                                        </span>
                                         @elseif($hasil->ranking == 2)
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-white font-extrabold text-sm shadow-lg" style="background: linear-gradient(135deg,#3f3f46 0%,#111827 100%); border:2px solid rgba(255,255,255,0.08);">
                                            {{ $hasil->ranking }}
                                        </span>
                                         @elseif($hasil->ranking == 3)
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-white font-extrabold text-sm shadow-lg" style="background: linear-gradient(135deg,#f97316 0%,#c2410c 100%); border:2px solid rgba(255,255,255,0.08);">
                                            {{ $hasil->ranking }}
                                        </span>
                                         @else
                                         <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full text-gray-700 font-bold text-sm">
                                             {{ $hasil->ranking }}
                                         </span>
                                         @endif
                                     </div>
                                 </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $hasil->alternatif->kode_alternatif }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $hasil->alternatif->nama_barang }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs">{{ $hasil->alternatif->stok_tersedia }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-bold leading-tight text-sm text-green-600">{{ number_format($hasil->nilai_akhir, 4) }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($hasil->status_rekomendasi == 'Prioritas Tinggi')
                                    <span class="inline-block px-3 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full">
                                        {{ $hasil->status_rekomendasi }}
                                    </span>
                                    @elseif($hasil->status_rekomendasi == 'Prioritas Sedang')
                                    <span class="inline-block px-3 py-1 text-xs font-bold bg-yellow-100 text-yellow-800 rounded-full">
                                        {{ $hasil->status_rekomendasi }}
                                    </span>
                                    @else
                                    <span class="inline-block px-3 py-1 text-xs font-bold bg-red-100 text-red-800 rounded-full">
                                        {{ $hasil->status_rekomendasi }}
                                    </span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs">{{ $hasil->tanggal_perhitungan->format('d/m/Y H:i') }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <form action="{{ route('hasil.destroy', $hasil->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus hasil ini?')"
                                                class="px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25">
                                            <i class="fas fa-trash text-red-500"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="p-6">
                <div class="text-center py-12">
                    <i class="fas fa-chart-line text-6xl text-gray-300 mb-4"></i>
                    <h6 class="mb-2 text-gray-600">Belum Ada Hasil Perhitungan</h6>
                    <p class="text-sm text-gray-500 mb-4">Silakan lakukan perhitungan terlebih dahulu</p>
                    <a href="{{ route('perhitungan.index') }}"
                       class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-calculator"></i> Mulai Perhitungan
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
