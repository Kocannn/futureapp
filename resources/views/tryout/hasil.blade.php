@extends('layouts.app')

@section('title', 'Hasil Tryout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Hasil Tryout</h1>
                <p class="text-gray-600 mt-2">{{ $hasil->paket->nama ?? $hasil->paket->judul }}</p>
                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                    <span>{{ \Carbon\Carbon::parse($hasil->waktu_selesai)->format('d M Y, H:i') }}</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button onclick="downloadPDF()" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </button>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-lg transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Score Overview Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-8">
        <div class="grid md:grid-cols-4 gap-6">
            <!-- Score Circle -->
            <div class="md:col-span-1 flex flex-col items-center justify-center">
                <div class="relative inline-flex items-center justify-center w-32 h-32 mb-4">
                    <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="54" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                        <circle cx="60" cy="60" r="54" fill="none"
                                stroke="{{ $hasil->skor >= 80 ? '#10b981' : ($hasil->skor >= 60 ? '#f59e0b' : '#ef4444') }}"
                                stroke-width="8"
                                stroke-linecap="round"
                                stroke-dasharray="{{ 2 * pi() * 54 }}"
                                stroke-dashoffset="{{ 2 * pi() * 54 * (1 - $hasil->skor / 100) }}"
                                class="transition-all duration-1000 ease-out"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900">{{ number_format($hasil->skor, 1) }}%</div>
                            <div class="text-sm text-gray-500">Skor Akhir</div>
                        </div>
                    </div>
                </div>

                <!-- Grade Badge -->
                @php
                    $grade = $hasil->skor >= 90 ? 'A' : ($hasil->skor >= 80 ? 'B' : ($hasil->skor >= 70 ? 'C' : ($hasil->skor >= 60 ? 'D' : 'E')));
                    $gradeColor = $hasil->skor >= 90 ? 'emerald' : ($hasil->skor >= 80 ? 'blue' : ($hasil->skor >= 70 ? 'yellow' : ($hasil->skor >= 60 ? 'orange' : 'red')));
                @endphp
                <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-{{ $gradeColor }}-100 text-{{ $gradeColor }}-800">
                    Grade {{ $grade }}
                </span>
            </div>

            <!-- Stats Grid -->
            <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="text-center p-6 bg-emerald-50 rounded-xl border border-emerald-100">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">JAWABAN BENAR</h3>
                    <p class="text-3xl font-bold text-emerald-600">{{ $hasil->jumlah_benar }}</p>
                    <p class="text-sm text-emerald-600 mt-1">dari {{ $hasil->jumlah_benar + $hasil->jumlah_salah }} soal</p>
                </div>

                <div class="text-center p-6 bg-red-50 rounded-xl border border-red-100">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">JAWABAN SALAH</h3>
                    <p class="text-3xl font-bold text-red-600">{{ $hasil->jumlah_salah }}</p>
                    <p class="text-sm text-red-600 mt-1">perlu diperbaiki</p>
                </div>

                <div class="text-center p-6 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">WAKTU PENGERJAAN</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ \Carbon\Carbon::parse($hasil->created_at)->diffInMinutes(\Carbon\Carbon::parse($hasil->waktu_selesai)) }}
                    </p>
                    <p class="text-sm text-blue-600 mt-1">menit</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions with explanations -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Pembahasan Soal ({{ count($jawaban) }} soal)
                </h2>
                <div class="flex items-center space-x-2">
                    <button onclick="filterAnswers('all')" class="filter-btn active px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                        Semua
                    </button>
                    <button onclick="filterAnswers('correct')" class="filter-btn px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 hover:bg-green-200 transition-colors">
                        Benar
                    </button>
                    <button onclick="filterAnswers('incorrect')" class="filter-btn px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 hover:bg-red-200 transition-colors">
                        Salah
                    </button>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="space-y-8" id="answers-container">
                @foreach($jawaban as $index => $jawab)
                    <div class="answer-item border-b border-gray-200 pb-8 last:border-0 last:pb-0 {{ $jawab->is_correct ? 'correct' : 'incorrect' }}"
                         data-status="{{ $jawab->is_correct ? 'correct' : 'incorrect' }}">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 {{ $jawab->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-lg flex items-center justify-center font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <!-- Question -->
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="font-medium text-gray-900 text-lg">Soal {{ $index + 1 }}</h3>
                                    @if($jawab->is_correct)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Benar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Salah
                                        </span>
                                    @endif
                                </div>

<div class="text-gray-800 font-medium mb-6 leading-relaxed">
    {!! $jawab->soal->pertanyaan !!}

    @if(!empty($jawab->soal->tables))
        @php
            $tableData = json_decode($jawab->soal->tables, true);
            $headers = $tableData['headers'] ?? [];
            $rows = $tableData['rows'] ?? [];
        @endphp
        <div class="overflow-x-auto my-4">
            <table class="min-w-full border border-gray-300 mb-4">
                <thead class="bg-gray-50">
                    <tr>
                        @foreach($headers as $header)
                            <th class="border border-gray-300 p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr class="bg-white">
                            @foreach($row as $cell)
                                <td class="border border-gray-300 p-2">
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

                                <!-- Options -->
                                <div class="grid grid-cols-1 gap-3 mb-6">
                                    @php
                                        $options = [
                                            'A' => $jawab->soal->pilihan_a,
                                            'B' => $jawab->soal->pilihan_b,
                                            'C' => $jawab->soal->pilihan_c,
                                            'D' => $jawab->soal->pilihan_d,
                                            'E' => $jawab->soal->pilihan_e
                                        ];
                                    @endphp

                                    @foreach($options as $key => $option)
                                        @if($option)
                                            <div class="flex items-center space-x-3 p-3 rounded-lg border
                                                {{ $key === $jawab->soal->jawaban_benar ? 'bg-green-50 border-green-200' : 'border-gray-200' }}
                                                {{ $key === $jawab->jawaban_user && $key !== $jawab->soal->jawaban_benar ? 'bg-red-50 border-red-200' : '' }}">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium
                                                    {{ $key === $jawab->soal->jawaban_benar ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }}
                                                    {{ $key === $jawab->jawaban_user && $key !== $jawab->soal->jawaban_benar ? 'bg-red-500 text-white' : '' }}">
                                                    {{ $key }}
                                                </div>
                                    <span class="text-gray-800 group-hover:text-gray-900">{!! $option !!}</span>
                                                <div class="flex items-center space-x-2">
                                                    @if($key === $jawab->jawaban_user)
                                                        <span class="text-xs text-blue-600 font-medium px-2 py-1 bg-blue-100 rounded-full">Jawaban Anda</span>
                                                    @endif
                                                    @if($key === $jawab->soal->jawaban_benar)
                                                        <span class="text-xs text-green-600 font-medium px-2 py-1 bg-green-100 rounded-full">Jawaban Benar</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                @if($jawab->soal->pembahasan)
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                        <h4 class="text-sm font-medium text-blue-900 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                            </svg>
                                            Pembahasan:
                                        </h4>
                                        <div class="text-sm text-blue-800 leading-relaxed">
                                            {!! nl2br(e($jawab->soal->pembahasan)) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script>
// Filter answers
function filterAnswers(type) {
    const answers = document.querySelectorAll('.answer-item');
    const buttons = document.querySelectorAll('.filter-btn');

    // Update button states
    buttons.forEach(btn => btn.classList.remove('active', 'bg-gray-200'));
    event.target.classList.add('active', 'bg-gray-200');

    // Filter answers
    answers.forEach(answer => {
        if (type === 'all') {
            answer.style.display = 'block';
        } else if (type === 'correct' && answer.dataset.status === 'correct') {
            answer.style.display = 'block';
        } else if (type === 'incorrect' && answer.dataset.status === 'incorrect') {
            answer.style.display = 'block';
        } else {
            answer.style.display = 'none';
        }
    });
}

// Download PDF
function downloadPDF() {
    // Show loading state
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    button.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Mengunduh...
    `;
    button.disabled = true;

    // Get the hasil ID from the URL
    const pathParts = window.location.pathname.split('/');
    const hasilId = pathParts[pathParts.length - 2];

    // Redirect to download URL
    window.location.href = `/tryout/${hasilId}/export-pdf`;
}

// Animate score circle on load
document.addEventListener('DOMContentLoaded', function() {
    const circle = document.querySelector('circle[stroke-dasharray]');
    if (circle) {
        setTimeout(() => {
            circle.style.strokeDashoffset = circle.getAttribute('stroke-dashoffset');
        }, 500);
    }
});
</script>
@endsection
