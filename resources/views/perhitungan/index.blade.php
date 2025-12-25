@extends('layouts.app')

@section('title', 'Perhitungan SAW')
@section('subtitle', 'Proses Perhitungan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <!-- Tombol Proses -->
    <div class="flex-none w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="mb-2">Perhitungan Metode SAW</h6>
                        <p class="text-sm text-slate-500">Simple Additive Weighting untuk Penentuan Persediaan Barang</p>
                    </div>
                    @if($isComplete)
                    <form action="{{ route('perhitungan.proses') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Proses perhitungan SAW sekarang?')"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-green-600 to-lime-400 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            <i class="fas fa-calculator"></i> Proses Perhitungan
                        </button>
                    </form>
                    @else
                    <div class="text-right">
                        <p class="text-sm text-red-500 font-semibold">⚠ Data penilaian belum lengkap!</p>
                        <a href="{{ route('penilaian.index') }}" class="text-xs text-blue-500 hover:underline">
                            Lengkapi penilaian →
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($isComplete && count($alternatifs) > 0)
    <!-- Matriks Keputusan -->
    <div class="flex-none w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>1. Matriks Keputusan (X)</h6>
                <p class="text-sm text-slate-500">Nilai asli dari setiap alternatif berdasarkan kriteria</p>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Alternatif
                                </th>
                                @foreach($kriterias as $kriteria)
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    {{ $kriteria->kode_kriteria }}
                                    <br>
                                    <span class="text-xxs font-normal">({{ ucfirst($kriteria->atribut) }})</span>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alternatifs as $alt)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs px-4">{{ $alt->kode_alternatif }}</p>
                                </td>
                                @foreach($kriterias as $krit)
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs">
                                        {{ $matriksKeputusan[$alt->id][$krit->id] ?? 0 }}
                                    </span>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bobot Kriteria -->
    <div class="flex-none w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6">
                <h6 class="mb-3">Bobot Kriteria (W)</h6>
                <div class="flex gap-4 flex-wrap">
                    @foreach($kriterias as $kriteria)
                    <div class="bg-gradient-to-tl from-purple-700 to-pink-500 rounded-lg px-4 py-2 text-white">
                        <span class="text-xs">{{ $kriteria->kode_kriteria }}</span>
                        <span class="font-bold ml-2">{{ $kriteria->bobot }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Matriks Normalisasi -->
    <div class="flex-none w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>2. Matriks Normalisasi (R)</h6>
                <p class="text-sm text-slate-500">Normalisasi nilai berdasarkan atribut benefit/cost</p>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Alternatif
                                </th>
                                @foreach($kriterias as $kriteria)
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    {{ $kriteria->kode_kriteria }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alternatifs as $alt)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs px-4">{{ $alt->kode_alternatif }}</p>
                                </td>
                                @foreach($kriterias as $krit)
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs text-blue-600">
                                        {{ number_format($matriksNormalisasi[$alt->id][$krit->id] ?? 0, 4) }}
                                    </span>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Nilai Preferensi -->
    <div class="flex-none w-full max-w-full px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>3. Nilai Preferensi (V)</h6>
                <p class="text-sm text-slate-500">Hasil perkalian matriks normalisasi dengan bobot kriteria</p>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Ranking
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Alternatif
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nama Barang
                                </th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nilai Preferensi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rank = 1; @endphp
                            @foreach($nilaiPreferensi as $alt_id => $nilai)
                            @php $alt = $alternatifs->find($alt_id); @endphp
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="inline-block px-3 py-1 text-xs font-bold {{ $rank <= 3 ? 'bg-green-100 text-green-800' : ($rank <= 7 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }} rounded-full">
                                        #{{ $rank }}
                                    </span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $alt->kode_alternatif }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $alt->nama_barang }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-bold leading-tight text-sm text-green-600">
                                        {{ number_format($nilai, 4) }}
                                    </span>
                                </td>
                            </tr>
                            @php $rank++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-4xl text-yellow-500 mb-3"></i>
                <h6 class="mb-2 text-yellow-800">Data Tidak Lengkap</h6>
                <p class="text-sm text-yellow-700">
                    Pastikan semua barang sudah memiliki nilai pada semua kriteria sebelum melakukan perhitungan.
                </p>
                <a href="{{ route('penilaian.index') }}" 
                   class="inline-block mt-4 px-6 py-2 text-sm font-bold text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                    Lengkapi Penilaian
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
