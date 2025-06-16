<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Riwayat Tryout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th {
            text-align: left;
            width: 30%;
        }
        .info-table td, .info-table th {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .paket-title {
            background: #f5f5f5;
            padding: 8px;
            margin: 15px 0 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .results-table th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .results-table td, .results-table th {
            padding: 5px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Riwayat Tryout</h1>
        <p>{{ $date }}</p>
    </div>

    <table class="info-table">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Total Paket</th>
            <td>{{ $results->count() }}</td>
        </tr>
        <tr>
            <th>Total Percobaan</th>
            <td>{{ $results->flatten()->count() }}</td>
        </tr>
    </table>

    @foreach($results as $paketId => $paketResults)
        @php $paket = $paketResults->first()->paket; @endphp
        <div class="paket-title">
            {{ $paket->judul }} ({{ $paketResults->count() }} percobaan)
        </div>

        <table class="results-table">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Skor</th>
                <th>Durasi</th>
                <th>Benar</th>
                <th>Salah</th>
            </tr>
            @foreach($paketResults as $index => $hasil)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $hasil->created_at->format('d M Y, H:i') }}</td>
                <td>{{ $hasil->skor }}</td>
                <td>{{ $hasil->waktu_selesai->diffInMinutes($hasil->waktu_mulai) }} menit</td>
                <td>{{ $hasil->jumlah_benar }}</td>
                <td>{{ $hasil->jumlah_salah }}</td>
            </tr>
            @endforeach
        </table>
    @endforeach

    <div style="text-align: center; font-size: 10px; margin-top: 30px;">
        Dokumen ini dicetak pada {{ now()->format('d F Y H:i') }}
    </div>
</body>
</html>
