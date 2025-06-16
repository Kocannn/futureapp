@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Hasil Tryout</h1>
                <p class="text-gray-600 mt-2">{{ $hasil->paket->judul }}</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-lg transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Score Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                <h3 class="text-sm font-medium text-gray-500 mb-1">SKOR</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $hasil->skor }}%</p>
            </div>
            <div class="p-4 bg-emerald-50 rounded-lg border border-emerald-100">
                <h3 class="text-sm font-medium text-gray-500 mb-1">BENAR</h3>
                <p class="text-3xl font-bold text-emerald-600">{{ count($jawabanBenar) }}</p>
            </div>
            <div class="p-4 bg-red-50 rounded-lg border border-red-100">
                <h3 class="text-sm font-medium text-gray-500 mb-1">SALAH</h3>
                <p class="text-3xl font-bold text-red-600">{{ count($jawabanSalah) }}</p>
            </div>

        </div>
    </div>

    <!-- Questions with explanations -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Pembahasan Soal</h2>

        <div class="space-y-8">
            @foreach($jawaban as $index => $jawab)
                <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-8 h-8 {{ $jawab->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full flex items-center justify-center font-semibold">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <!-- Question -->
                            <div class="text-gray-800 font-medium mb-4">
                                {!! $jawab->soal->pertanyaan !!}
                            </div>

                            <!-- Options -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-4">
                                <div class="flex items-center p-2 rounded {{ $jawab->soal->jawaban_benar == 'A' ? 'bg-green-50 border border-green-200' : '' }} {{ $jawab->jawaban_user == 'A' && $jawab->jawaban_user != $jawab->soal->jawaban_benar ? 'bg-red-50 border border-red-200' : '' }}">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center {{ $jawab->soal->jawaban_benar == 'A' ? 'bg-green-500 text-white' : 'bg-gray-200' }} mr-2">A</span>
                                    <span>{{ $jawab->soal->jawaban_a }}</span>
                                </div>

                                <div class="flex items-center p-2 rounded {{ $jawab->soal->jawaban_benar == 'B' ? 'bg-green-50 border border-green-200' : '' }} {{ $jawab->jawaban_user == 'B' && $jawab->jawaban_user != $jawab->soal->jawaban_benar ? 'bg-red-50 border border-red-200' : '' }}">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center {{ $jawab->soal->jawaban_benar == 'B' ? 'bg-green-500 text-white' : 'bg-gray-200' }} mr-2">B</span>
                                    <span>{{ $jawab->soal->jawaban_b }}</span>
                                </div>

                                <div class="flex items-center p-2 rounded {{ $jawab->soal->jawaban_benar == 'C' ? 'bg-green-50 border border-green-200' : '' }} {{ $jawab->jawaban_user == 'C' && $jawab->jawaban_user != $jawab->soal->jawaban_benar ? 'bg-red-50 border border-red-200' : '' }}">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center {{ $jawab->soal->jawaban_benar == 'C' ? 'bg-green-500 text-white' : 'bg-gray-200' }} mr-2">C</span>
                                    <span>{{ $jawab->soal->jawaban_c }}</span>
                                </div>

                                <div class="flex items-center p-2 rounded {{ $jawab->soal->jawaban_benar == 'D' ? 'bg-green-50 border border-green-200' : '' }} {{ $jawab->jawaban_user == 'D' && $jawab->jawaban_user != $jawab->soal->jawaban_benar ? 'bg-red-50 border border-red-200' : '' }}">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center {{ $jawab->soal->jawaban_benar == 'D' ? 'bg-green-500 text-white' : 'bg-gray-200' }} mr-2">D</span>
                                    <span>{{ $jawab->soal->jawaban_d }}</span>
                                </div>

                                @if($jawab->soal->jawaban_e)
                                <div class="flex items-center p-2 rounded {{ $jawab->soal->jawaban_benar == 'E' ? 'bg-green-50 border border-green-200' : '' }} {{ $jawab->jawaban_user == 'E' && $jawab->jawaban_user != $jawab->soal->jawaban_benar ? 'bg-red-50 border border-red-200' : '' }}">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center {{ $jawab->soal->jawaban_benar == 'E' ? 'bg-green-500 text-white' : 'bg-gray-200' }} mr-2">E</span>
                                    <span>{{ $jawab->soal->jawaban_e }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- User's answer -->
                            <div class="mb-4">
                                <span class="text-sm font-medium text-gray-600">Jawaban Anda:</span>
                                <span class="ml-2 px-2 py-1 rounded {{ $jawab->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $jawab->jawaban_user }}
                                </span>
                                <span class="ml-2 text-sm">
                                    {{ $jawab->is_correct ? '✓ Benar' : '✗ Salah' }}
                                </span>
                            </div>

                            <!-- Explanation -->
                            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-blue-800 mb-2">Pembahasan:</h4>
                                <div class="text-sm text-gray-700">
                                    {!! $jawab->soal->pembahasan !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
