<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hasil Tryout</title>
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
        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .result-table th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .result-table td, .result-table th {
            padding: 5px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        .correct {
            color: green;
        }
        .incorrect {
            color: red;
        }
        .score {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hasil Tryout</h1>
        <p>{{ now()->format('d F Y') }}</p>
    </div>

    <table class="info-table">
        <tr>
            <th>Nama</th>
            <td>{{ $hasil->user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $hasil->user->email }}</td>
        </tr>
        <tr>
            <th>Paket Tryout</th>
            <td>{{ $hasil->paket->judul }}</td>
        </tr>
        <tr>
            <th>Tanggal Pengerjaan</th>
            <td>{{ $hasil->created_at->format('d F Y H:i') }}</td>
        </tr>
        <tr>
            <th>Durasi</th>
            <td>{{ $hasil->waktu_selesai->diffInMinutes($hasil->waktu_mulai) }} menit</td>
        </tr>
    </table>

    <div class="score">
        Skor: {{ $hasil->skor }}
        ({{ $jawabanBenar->count() }} benar, {{ $jawabanSalah->count() }} salah)
    </div>

    <h2>Detail Jawaban</h2>
    <table class="result-table">
        <tr>
            <th>No.</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
            <th>Jawaban Benar</th>
            <th>Status</th>
        </tr>
        @foreach($jawaban as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->soal->pertanyaan }}</td>
            <td>{{ $item->jawaban_user }}</td>
            <td>{{ $item->soal->jawaban_benar }}</td>
            <td class="{{ $item->is_correct ? 'correct' : 'incorrect' }}">
                {{ $item->is_correct ? 'Benar' : 'Salah' }}
            </td>
        </tr>
        @endforeach
    </table>

    <div style="text-align: center; font-size: 10px; margin-top: 30px;">
        Dokumen ini dicetak pada {{ now()->format('d F Y H:i') }}
    </div>
</body>
</html>
