@extends('layouts.app')

@section('title', 'Daftar Peringkat')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Peringkat Tryout</h1>
            <p class="text-gray-600 mt-2">Lihat peringkat peserta berdasarkan paket soal</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.peringkat.top') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Lihat Peringkat Tertinggi
            </a>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($pakets as $paket)
            <a href="{{ route('admin.peringkat.show', $paket->id) }}" class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-semibold text-gray-900">{{ $paket->nama ?? $paket->judul }}</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-sm text-gray-600">
                            <svg class="w-5 h-5 inline-block mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                            </svg>
                            {{ $paket->durasi ?? '90' }} menit
                        </div>
                        <div class="text-sm text-gray-600">
                            @php
                                $participantCount = \App\Models\HasilTryout::where('paket_id', $paket->id)->count();
                            @endphp
                            <span class="font-semibold">{{ $participantCount }}</span> peserta
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-blue-100 text-blue-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Lihat Peringkat
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-xl border border-gray-200 p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Paket Tryout</h3>
                <p class="text-gray-500">Tidak ada paket tryout yang tersedia untuk ditampilkan peringkatnya.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
