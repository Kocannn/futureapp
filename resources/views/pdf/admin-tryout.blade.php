<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admin - Hasil Tryout</title>
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
            background: #f5f5f5;
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
        <h1>Laporan Hasil Tryout (Admin)</h1>
        <p>{{ $date }}</p>
    </div>

    <table class="info-table">
        <tr>
            <th>Nama Peserta</th>
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
            <th>Percobaan Ke-</th>
            <td>{{ $hasil->attempt_number }}</td>
        </tr>
        <tr>
            <th>Tanggal Pengerjaan</th>
            <td>{{ $hasil->created_at->format('d F Y H:i') }}</td>
        </tr>
        <tr>
            <th>Durasi</th>
            <td>{{ \Carbon\Carbon::parse($hasil->waktu_selesai)->diffInMinutes(\Carbon\Carbon::parse($hasil->waktu_mulai)) }} menit</td>
        </tr>
    </table>

    <div class="score">
        Skor: {{ $hasil->skor }}
        ({{ $jawaban->where('is_correct', true)->count() }} benar,
        {{ $jawaban->where('is_correct', false)->count() }} salah)
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

    <h2 style="margin-top: 20px;">Pembahasan Soal</h2>
    @foreach($jawaban as $index => $item)
<div style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; background-color: #f9f9f9;">
    <div style="font-weight: bold; margin-bottom: 5px;">Soal #{{ $index + 1 }}</div>
    <div style="margin-bottom: 5px;">
        {{ $item->soal->pertanyaan }}

        @if(!empty($item->soal->tables))
            @php
                $tableData = json_decode($item->soal->tables, true);
                $headers = $tableData['headers'] ?? [];
                $rows = $tableData['rows'] ?? [];
            @endphp
            <div style="margin-top: 10px; margin-bottom: 10px; overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; font-size: 10px;">
                    <thead>
                        <tr style="background-color: #f5f5f5;">
                            @foreach($headers as $header)
                                <th style="border: 1px solid #ddd; padding: 4px; text-align: left; font-weight: bold;">
                                    {{ $header }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $row)
                            <tr>
                                @foreach($row as $cell)
                                    <td style="border: 1px solid #ddd; padding: 4px;">
                                        {{ $cell }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div style="display: flex; margin-bottom: 5px;">
        <div style="width: 120px; font-weight: bold;">Jawaban Anda:</div>
        <div class="{{ $item->is_correct ? 'correct' : 'incorrect' }}">{{ $item->jawaban_user }}</div>
    </div>

        <div style="display: flex; margin-bottom: 10px;">
            <div style="width: 120px; font-weight: bold;">Jawaban Benar:</div>
            <div>{{ $item->soal->jawaban_benar }}</div>
        </div>

        @if($item->soal->pembahasan)
        <div style="border-top: 1px dashed #ccc; padding-top: 8px;">
            <div style="font-weight: bold; margin-bottom: 3px;">Pembahasan:</div>
            <div>{{ $item->soal->pembahasan }}</div>
        </div>
        @else
        <div style="border-top: 1px dashed #ccc; padding-top: 8px; color: #888;">
            Tidak ada pembahasan untuk soal ini.
        </div>
        @endif
    </div>
    @endforeach

    <div style="text-align: center; font-size: 10px; margin-top: 30px;">

</body>
</html>
