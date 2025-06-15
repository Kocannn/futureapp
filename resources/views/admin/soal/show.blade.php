@extends('layouts.app')

@section('title', 'Detail Soal')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.soal.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Detail Soal</h1>
        <p class="text-gray-600 mt-2">Informasi lengkap tentang soal tryout</p>
    </div>

    <!-- Content Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Informasi Soal
            </h2>
        </div>

        <div class="p-6">
            <div class="space-y-6">
                <!-- Paket Info -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Paket Soal</h3>
                    <p class="text-gray-900">{{ $soal->paket->nama ?? $soal->paket->judul ?? 'Tidak ada paket' }}</p>
                </div>

                <!-- Pertanyaan -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Pertanyaan</h3>
                    <div class="p-4 bg-gray-50 rounded-lg text-gray-900">{{ $soal->pertanyaan }}</div>
                </div>

                <!-- Pilihan Jawaban -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Pilihan Jawaban</h3>
                    <div class="space-y-2">
                        @php
                            $options = [
                                'A' => $soal->pilihan_a,
                                'B' => $soal->pilihan_b,
                                'C' => $soal->pilihan_c,
                                'D' => $soal->pilihan_d,
                                'E' => $soal->pilihan_e
                            ];
                        @endphp

                        @foreach($options as $key => $value)
                            @if($value)
                                <div class="flex items-center space-x-3 p-2 rounded-lg {{ $key === $soal->jawaban_benar ? 'bg-green-50 border border-green-200' : 'bg-gray-50 border border-gray-100' }}">
                                    <div class="w-8 h-8 {{ $key === $soal->jawaban_benar ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full flex items-center justify-center">
                                        <span class="font-medium">{{ $key }}</span>
                                    </div>
                                    <span class="text-gray-800">{{ $value }}</span>
                                    @if($key === $soal->jawaban_benar)
                                        <span class="text-sm text-green-600 font-medium">(Jawaban Benar)</span>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Pembahasan -->
                @if($soal->pembahasan)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Pembahasan</h3>
                        <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg text-blue-800">
                            {{ $soal->pembahasan }}
                        </div>
                    </div>
                @endif

                <!-- Additional Info -->
                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 mt-4">
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 mb-1">ID Soal</h3>
                        <p class="text-sm text-gray-900">{{ $soal->id }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 mb-1">Terakhir Diupdate</h3>
                        <p class="text-sm text-gray-900">{{ $soal->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-200">
            <a href="{{ route('admin.soal.edit', $soal->id) }}"
                class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Soal
            </a>
            <form action="{{ route('admin.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
