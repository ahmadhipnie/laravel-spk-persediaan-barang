<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Perhitungan SAW</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 5px;
        }
        h2 {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .header {
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-high {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-medium {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-low {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HASIL PERHITUNGAN SAW</h1>
        <h2>Sistem Pendukung Keputusan Penentuan Persediaan Barang</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%; text-align: center;">Rank</th>
                <th style="width: 12%;">Kode</th>
                <th style="width: 30%;">Nama Barang</th>
                <th style="width: 10%; text-align: center;">Stok</th>
                <th style="width: 15%; text-align: center;">Nilai Akhir</th>
                <th style="width: 25%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasils as $hasil)
            <tr>
                <td style="text-align: center; font-weight: bold;">{{ $hasil->ranking }}</td>
                <td>{{ $hasil->alternatif->kode_alternatif }}</td>
                <td>{{ $hasil->alternatif->nama_barang }}</td>
                <td style="text-align: center;">{{ $hasil->alternatif->stok_tersedia }}</td>
                <td style="text-align: center; font-weight: bold;">{{ number_format($hasil->nilai_akhir, 4) }}</td>
                <td style="text-align: center;">
                    <span class="badge 
                        @if($hasil->status_rekomendasi == 'Prioritas Tinggi') badge-high
                        @elseif($hasil->status_rekomendasi == 'Prioritas Sedang') badge-medium
                        @else badge-low
                        @endif">
                        {{ $hasil->status_rekomendasi }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
