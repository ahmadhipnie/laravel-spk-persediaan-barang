@extends('layouts.app')
@section('title', 'Dashboard')
@section('subtitle', 'Sistem Pendukung Keputusan')

@section('content')

<div class="flex flex-wrap -mx-3">
    <!-- Statistics Cards Row -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-500">
                                Total Barang
                            </p>
                            <h5 class="mb-0 font-bold">
                                {{ $totalAlternatif }}
                                <span class="text-xs leading-normal text-slate-400">item</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="fas fa-boxes text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-500">
                                Kriteria Aktif
                            </p>
                            <h5 class="mb-0 font-bold">
                                {{ $totalKriteria }}
                                <span class="text-xs leading-normal text-slate-400">kriteria</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-lime-400">
                            <i class="fas fa-list-check text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-500">
                                Prioritas Tinggi
                            </p>
                            <h5 class="mb-0 font-bold">
                                {{ \App\Models\HasilPerhitungan::where('status_rekomendasi', 'Prioritas Tinggi')->count() }}
                                <span class="text-xs leading-normal text-red-600">urgent</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-red-600 to-rose-400">
                            <i class="fas fa-exclamation-triangle text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-500">
                                Perhitungan
                            </p>
                            <h5 class="mb-0 font-bold">
                                {{ \App\Models\HasilPerhitungan::count() }}
                                <span class="text-xs leading-normal text-lime-500">total</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-yellow-600 to-yellow-400">
                            <i class="fas fa-calculator text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Analytics Row -->
<div class="flex flex-wrap mt-6 -mx-3">
    <!-- Priority Distribution Chart -->
    <div class="w-full max-w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6 class="font-bold">Distribusi Prioritas</h6>
                <p class="text-sm leading-normal text-slate-500">
                    <i class="fa fa-chart-bar text-purple-500"></i>
                    <span class="font-semibold">Analisis prioritas barang</span>
                </p>
            </div>
            <div class="flex-auto p-4">
                <div class="relative">
                    <canvas id="priorityChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 5 Recommendations -->
    <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6 class="font-bold">Top 5 Rekomendasi</h6>
                <p class="text-sm leading-normal text-slate-500">Ranking tertinggi</p>
            </div>
            <div class="flex-auto p-4">
                @if($topRekomendasi && $topRekomendasi->count() > 0)
                    <div class="space-y-3">
                        @foreach($topRekomendasi as $index => $hasil)
                            <div class="flex items-center p-3 rounded-lg {{ $index < 3 ? 'bg-gradient-to-r' : 'bg-gray-50' }}
                                {{ $index === 0 ? 'from-yellow-50 to-yellow-100 border border-yellow-200' : '' }}
                                {{ $index === 1 ? 'from-gray-50 to-gray-100 border border-gray-300' : '' }}
                                {{ $index === 2 ? 'from-orange-50 to-orange-100 border border-orange-200' : '' }}">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg
                                    {{ $index === 0 ? 'bg-gradient-to-tl from-yellow-600 to-yellow-400' : '' }}
                                    {{ $index === 1 ? 'bg-gradient-to-tl from-gray-400 to-gray-300' : '' }}
                                    {{ $index === 2 ? 'bg-gradient-to-tl from-orange-600 to-orange-400' : '' }}
                                    {{ $index > 2 ? 'bg-gradient-to-tl from-purple-700 to-pink-500' : '' }}">
                                    <span class="text-sm font-bold text-white">#{{ $hasil->ranking }}</span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-sm font-semibold">{{ $hasil->alternatif->nama_barang ?? 'N/A' }}</h6>
                                    <p class="mb-0 text-xs text-slate-500">
                                        Score: <span class="font-bold text-purple-600">{{ number_format($hasil->nilai_akhir, 4) }}</span>
                                    </p>
                                </div>
                                @if($index < 3)
                                    <i class="fas fa-medal text-2xl
                                        {{ $index === 0 ? 'text-yellow-500' : '' }}
                                        {{ $index === 1 ? 'text-gray-400' : '' }}
                                        {{ $index === 2 ? 'text-orange-500' : '' }}"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex items-center justify-center h-64 text-center">
                        <div>
                            <i class="fas fa-inbox text-4xl text-slate-300 mb-3"></i>
                            <p class="text-slate-500">Belum ada data perhitungan</p>
                            <a href="{{ route('perhitungan.index') }}" class="text-sm text-purple-600 hover:text-purple-700">
                                Mulai Perhitungan <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Stock Status and Quick Actions Row -->
<div class="flex flex-wrap mt-6 -mx-3">
    <!-- Stock Status Chart -->
    <div class="w-full max-w-full px-3 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6 class="font-bold">Status Stok Barang</h6>
                <p class="text-sm leading-normal text-slate-500">
                    <i class="fa fa-box text-green-500"></i>
                    <span class="font-semibold">Monitoring persediaan</span>
                </p>
            </div>
            <div class="flex-auto p-4">
                <div class="relative h-64 flex items-center justify-center">
                    <canvas id="stockChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Last Calculation -->
    <div class="w-full max-w-full px-3 lg:w-7/12 lg:flex-none">
        <div class="space-y-4">
            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('perhitungan.index') }}" class="block">
                    <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-xl rounded-2xl bg-clip-border transform transition-transform hover:scale-105">
                        <div class="flex-auto p-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-center bg-white rounded-lg bg-opacity-20">
                                    <i class="fas fa-calculator text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-white font-bold">Perhitungan SAW</h6>
                                    <p class="mb-0 text-xs text-white text-opacity-80">Proses analisis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('hasil.index') }}" class="block">
                    <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-green-600 to-lime-400 shadow-soft-xl rounded-2xl bg-clip-border transform transition-transform hover:scale-105">
                        <div class="flex-auto p-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-center bg-white rounded-lg bg-opacity-20">
                                    <i class="fas fa-trophy text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-white font-bold">Hasil Ranking</h6>
                                    <p class="mb-0 text-xs text-white text-opacity-80">Lihat hasil</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('barang.index') }}" class="block">
                    <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-blue-600 to-cyan-400 shadow-soft-xl rounded-2xl bg-clip-border transform transition-transform hover:scale-105">
                        <div class="flex-auto p-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-center bg-white rounded-lg bg-opacity-20">
                                    <i class="fas fa-boxes text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-white font-bold">Data Barang</h6>
                                    <p class="mb-0 text-xs text-white text-opacity-80">Kelola barang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('penilaian.index') }}" class="block">
                    <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-red-600 to-rose-400 shadow-soft-xl rounded-2xl bg-clip-border transform transition-transform hover:scale-105">
                        <div class="flex-auto p-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-center bg-white rounded-lg bg-opacity-20">
                                    <i class="fas fa-star text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-white font-bold">Penilaian</h6>
                                    <p class="mb-0 text-xs text-white text-opacity-80">Input nilai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Last Calculation Info -->
            @if($hasilTerakhir)
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 text-center rounded-lg bg-gradient-to-tl from-yellow-600 to-yellow-400">
                            <i class="fas fa-clock text-lg text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="mb-0 text-sm font-semibold">Perhitungan Terakhir</h6>
                            <p class="mb-0 text-xs text-slate-500">
                                {{ $hasilTerakhir->tanggal_perhitungan ? \Carbon\Carbon::parse($hasilTerakhir->tanggal_perhitungan)->format('d M Y, H:i') : 'N/A' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 text-xs font-bold text-white rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                {{ $hasilTerakhir->alternatif->nama_barang ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('theme/js/plugins/chartjs.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah Chart.js sudah terload
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded!');
        return;
    }

    // Priority Distribution Chart
    const priorityCanvas = document.getElementById('priorityChart');
    if (priorityCanvas) {
        // Setup canvas
        const parent = priorityCanvas.parentElement;
        if (parent) {
            const containerHeight = parent.clientHeight || 300;
            priorityCanvas.width = parent.clientWidth;
            priorityCanvas.height = containerHeight;
        }

        // Pastikan data valid
        const highPriority = {{ \App\Models\HasilPerhitungan::where('status_rekomendasi', 'Prioritas Tinggi')->count() }};
        const mediumPriority = {{ \App\Models\HasilPerhitungan::where('status_rekomendasi', 'Prioritas Sedang')->count() }};
        const lowPriority = {{ \App\Models\HasilPerhitungan::where('status_rekomendasi', 'Prioritas Rendah')->count() }};

        // Cek jika semua data 0
        if (highPriority === 0 && mediumPriority === 0 && lowPriority === 0) {
            // Tampilkan placeholder message
            const ctx = priorityCanvas.getContext('2d');
            ctx.fillStyle = '#f3f4f6';
            ctx.fillRect(0, 0, priorityCanvas.width, priorityCanvas.height);
            ctx.fillStyle = '#6b7280';
            ctx.textAlign = 'center';
            ctx.font = '16px Arial';
            ctx.fillText('Belum ada data', priorityCanvas.width/2, priorityCanvas.height/2);
            return;
        }

        const priorityData = {
            labels: ['Prioritas Tinggi', 'Prioritas Sedang', 'Prioritas Rendah'],
            datasets: [{
                label: 'Jumlah Barang',
                data: [highPriority, mediumPriority, lowPriority],
                backgroundColor: [
                    'rgba(239, 68, 68, 0.8)',   // red-500
                    'rgba(245, 158, 11, 0.8)',  // yellow-500
                    'rgba(16, 185, 129, 0.8)'   // green-500
                ],
                borderColor: [
                    'rgb(220, 38, 38)',         // red-600
                    'rgb(217, 119, 6)',         // yellow-600
                    'rgb(5, 150, 105)'          // green-600
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false
            }]
        };

        try {
            new Chart(priorityCanvas, {
                type: 'bar',
                data: priorityData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.parsed.y} item`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating priority chart:', error);
        }
    }

    // Stock Status Chart
    const stockCanvas = document.getElementById('stockChart');
    if (stockCanvas) {
        // Setup canvas
        const parent = stockCanvas.parentElement;
        if (parent) {
            stockCanvas.width = parent.clientWidth;
            stockCanvas.height = parent.clientHeight || 250;
        }

        // Hitung data
        const safeStock = {{ \App\Models\Alternatif::join('barang', 'alternatif.barang_id', '=', 'barang.id')
            ->whereColumn('alternatif.stok_tersedia', '>=', 'barang.stok_minimum')
            ->count() }};
        const lowStock = {{ \App\Models\Alternatif::join('barang', 'alternatif.barang_id', '=', 'barang.id')
            ->whereColumn('alternatif.stok_tersedia', '<', 'barang.stok_minimum')
            ->count() }};
        const criticalStock = {{ \App\Models\Alternatif::where('stok_tersedia', '<=', 0)->count() }};

        // Cek jika semua data 0
        if (safeStock === 0 && lowStock === 0 && criticalStock === 0) {
            const ctx = stockCanvas.getContext('2d');
            ctx.fillStyle = '#f3f4f6';
            ctx.fillRect(0, 0, stockCanvas.width, stockCanvas.height);
            ctx.fillStyle = '#6b7280';
            ctx.textAlign = 'center';
            ctx.font = '16px Arial';
            ctx.fillText('Belum ada data stok', stockCanvas.width/2, stockCanvas.height/2);
            return;
        }

        const stockData = {
            labels: ['Stok Aman', 'Stok Rendah', 'Stok Kritis'],
            datasets: [{
                data: [safeStock, lowStock, criticalStock],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',   // green
                    'rgba(234, 179, 8, 0.8)',   // yellow
                    'rgba(220, 38, 38, 0.8)'    // red
                ],
                borderColor: [
                    'rgb(34, 197, 94)',
                    'rgb(234, 179, 8)',
                    'rgb(220, 38, 38)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        };

        try {
            new Chart(stockCanvas, {
                type: 'doughnut',
                data: stockData,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 12
                                },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${label}: ${value} item (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });
        } catch (error) {
            console.error('Error creating stock chart:', error);
        }
    }
});
</script>
@endpush

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
