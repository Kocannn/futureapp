
@extends('layouts.app')

@section('title', 'Detail Hasil Tryout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.hasil.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Hasil Tryout</h1>
                <p class="text-gray-600 mt-2">Analisis lengkap hasil tryout pengguna</p>
            </div>
            <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                <button onclick="downloadPDF()" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </button>

            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- User & Test Info -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Peserta & Tryout
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User Info -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Informasi Peserta</h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                                        <span class="text-lg font-semibold text-blue-700">{{ substr($hasil->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $hasil->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $hasil->user->email ?? 'Email tidak tersedia' }}</p>
                                    </div>
                                </div>
<div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Percobaan ke-</span>
                                    <span class="font-semibold text-gray-900">{{ $hasil->attempt_number }}</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p><span class="font-medium">ID Pengguna:</span> {{ $hasil->user->id }}</p>
                                    <p><span class="font-medium">Bergabung:</span> {{ $hasil->user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Test Info -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Informasi Tryout</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Paket Soal:</span>
                                    <span class="font-medium text-gray-900">{{ $hasil->paket->nama }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Soal:</span>
                                    <span class="font-medium text-gray-900">{{ $hasil->jumlah_benar + $hasil->jumlah_salah }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Durasi:</span>
                                    <span class="font-medium text-gray-900">{{ $hasil->paket->durasi }} menit</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Mulai:</span>
                                    <span class="font-medium text-gray-900">{{ $hasil->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Selesai:</span>
                                    <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($hasil->waktu_selesai)->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Waktu Pengerjaan:</span>
                                    <span class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($hasil->created_at)->diffInMinutes(\Carbon\Carbon::parse($hasil->waktu_selesai)) }} menit
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score Overview -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Ringkasan Nilai
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Score Circle -->
                    <div class="text-center mb-6">
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

                    <!-- Detailed Stats -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $hasil->jumlah_benar }}</div>
                            <div class="text-sm text-green-700">Jawaban Benar</div>
                        </div>
                        <div class="text-center p-4 bg-red-50 rounded-lg">
                            <div class="text-2xl font-bold text-red-600">{{ $hasil->jumlah_salah }}</div>
                            <div class="text-sm text-red-700">Jawaban Salah</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-gray-600">{{ ($hasil->jumlah_benar + $hasil->jumlah_salah) }}</div>
                            <div class="text-sm text-gray-700">Total Soal</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Answers -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Detail Jawaban ({{ count($jawaban_detail) }} soal)
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
                    <div class="space-y-6" id="answers-container">
                        @foreach($jawaban_detail as $index => $jawaban)
                            <div class="answer-item border border-gray-200 rounded-lg p-4 {{ $jawaban->is_correct ? 'correct' : 'incorrect' }}"
                                 data-status="{{ $jawaban->is_correct ? 'correct' : 'incorrect' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 {{ $jawaban->is_correct ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }} rounded-lg flex items-center justify-center">
                                            <span class="text-sm font-medium">{{ $index + 1 }}</span>
                                        </div>
                                        <h3 class="font-medium text-gray-900">Soal {{ $index + 1 }}</h3>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($jawaban->is_correct)
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
                                </div>

                                <div class="mb-4">
                                    <p class="text-gray-800 leading-relaxed">{{ $jawaban->soal->pertanyaan }}</p>
                                </div>

                                <div class="grid grid-cols-1 gap-2">
                                    @php
                                        $options = [
                                            'A' => $jawaban->soal->pilihan_a,
                                            'B' => $jawaban->soal->pilihan_b,
                                            'C' => $jawaban->soal->pilihan_c,
                                            'D' => $jawaban->soal->pilihan_d,
                                            'E' => $jawaban->soal->pilihan_e
                                        ];
                                    @endphp

                                    @foreach($options as $key => $option)
                                        <div class="flex items-center space-x-3 p-2 rounded-lg
                                            {{ $key === $jawaban->soal->jawaban_benar ? 'bg-green-50 border border-green-200' : '' }}
                                            {{ $key === $jawaban->jawaban_user && $key !== $jawaban->soal->jawaban_benar ? 'bg-red-50 border border-red-200' : '' }}">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-sm font-medium
                                                {{ $key === $jawaban->soal->jawaban_benar ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }}
                                                {{ $key === $jawaban->jawaban_user && $key !== $jawaban->soal->jawaban_benar ? 'bg-red-500 text-white' : '' }}">
                                                {{ $key }}
                                            </div>
                                            <span class="text-gray-800 {{ $key === $jawaban->soal->jawaban_benar ? 'font-medium' : '' }}">
                                                {{ $option }}
                                            </span>
                                            @if($key === $jawaban->jawaban_user)
                                                <span class="text-xs text-blue-600 font-medium">(Jawaban Anda)</span>
                                            @endif
                                            @if($key === $jawaban->soal->jawaban_benar)
                                                <span class="text-xs text-green-600 font-medium">(Jawaban Benar)</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                @if($jawaban->soal->pembahasan)
                                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                        <h4 class="text-sm font-medium text-blue-900 mb-2">Pembahasan:</h4>
                                        <p class="text-sm text-blue-800">{{ $jawaban->soal->pembahasan }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Performance Summary -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Ringkasan Performa
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Akurasi</span>
                        <span class="font-semibold text-gray-900">{{ number_format(($hasil->jumlah_benar / ($hasil->jumlah_benar + $hasil->jumlah_salah)) * 100, 1) }}%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Waktu per Soal</span>
                        <span class="font-semibold text-gray-900">
                            {{ number_format(\Carbon\Carbon::parse($hasil->created_at)->diffInMinutes(\Carbon\Carbon::parse($hasil->waktu_selesai)) / ($hasil->jumlah_benar + $hasil->jumlah_salah), 1) }} menit
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Efisiensi Waktu</span>
                        <span class="font-semibold text-gray-900">
                            {{ number_format((\Carbon\Carbon::parse($hasil->created_at)->diffInMinutes(\Carbon\Carbon::parse($hasil->waktu_selesai)) / $hasil->paket->durasi) * 100, 1) }}%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Comparison -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Perbandingan
                </h3>
                <div class="space-y-4">
                    @php
                        $avgScore = \App\Models\HasilTryout::where('paket_id', $hasil->paket_id)->avg('skor');
                        $maxScore = \App\Models\HasilTryout::where('paket_id', $hasil->paket_id)->max('skor');
                        $rank = \App\Models\HasilTryout::where('paket_id', $hasil->paket_id)->where('skor', '>', $hasil->skor)->count() + 1;
                        $totalParticipants = \App\Models\HasilTryout::where('paket_id', $hasil->paket_id)->count();
                    @endphp

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Rata-rata Kelas</span>
                        <span class="font-semibold text-gray-900">{{ number_format($avgScore, 1) }}%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Skor Tertinggi</span>
                        <span class="font-semibold text-gray-900">{{ number_format($maxScore, 1) }}%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Peringkat</span>
                        <span class="font-semibold text-gray-900">{{ $rank }} dari {{ $totalParticipants }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Persentil</span>
                        <span class="font-semibold text-gray-900">{{ number_format((($totalParticipants - $rank + 1) / $totalParticipants) * 100, 1) }}%</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Aksi Cepat
                </h3>
                <div class="space-y-3">
                    <button onclick="downloadPDF()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Laporan
                    </button>

                </div>
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
    // Implement PDF download logic
    alert('Mengunduh laporan PDF...');
}

// Send Email
function sendEmail() {
    // Implement email sending logic
    alert('Mengirim hasil ke email peserta...');
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
