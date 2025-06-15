@extends('layouts.app')

@section('title', 'Detail Paket Soal')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.paket.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $paket->nama ?? $paket->judul }}</h1>
                <p class="text-gray-600 mt-2">Detail informasi paket soal tryout</p>
            </div>
            <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                <a href="{{ route('admin.paket.edit', $paket->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Paket
                </a>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Dasar
                    </h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Paket</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $paket->nama ?? $paket->judul }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Durasi</dt>
                            <dd class="mt-1 text-sm text-gray-900 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                                {{ $paket->durasi ?? 'Tidak ditentukan' }} menit
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($paket->status ?? 'aktif') === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($paket->status ?? 'aktif') }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Dibuat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $paket->created_at->format('d M Y, H:i') }}</dd>
                        </div>
                        @if($paket->is_new ?? false)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Label</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Paket Terbaru
                                </span>
                            </dd>
                        </div>
                        @endif
                        @if($paket->kategori ?? false)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $paket->kategori->nama }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Deskripsi
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $paket->deskripsi ?? 'Tidak ada deskripsi tersedia untuk paket ini.' }}
                    </p>
                </div>
            </div>

            <!-- Questions List Card -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Daftar Soal ({{ $paket->soals->count() ?? 0 }})
                        </h2>
                        <a href="{{ route('admin.soal.create', ['paket_id' => $paket->id]) }}"
                           class="inline-flex items-center px-3 py-1.5 bg-purple-600 border border-transparent rounded-lg text-xs font-medium text-white hover:bg-purple-700 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Soal
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if($paket->soals && $paket->soals->count() > 0)
                        <div class="space-y-4">
                            @foreach($paket->soals as $index => $soal)
                                <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-lg hover:border-gray-300 transition-colors">
                                    <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-medium text-purple-700">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900 line-clamp-2">{{ Str::limit($soal->pertanyaan, 100) }}</p>
                                        <div class="mt-2 flex items-center space-x-4 text-xs text-gray-500">
                                            <span>ID: {{ $soal->id }}</span>
                                            <span>{{ $soal->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.soal.show', $soal->id) }}"
                                           class="text-blue-600 hover:text-blue-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.soal.edit', $soal->id) }}"
                                           class="text-amber-600 hover:text-amber-900 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Belum Ada Soal</h3>
                            <p class="text-sm text-gray-500 mb-4">Paket ini belum memiliki soal. Tambahkan soal untuk melengkapi paket tryout.</p>
                            <a href="{{ route('admin.soal.create', ['paket_id' => $paket->id]) }}"
                               class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-purple-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Soal Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Paket</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Soal</span>
                        <span class="font-semibold text-gray-900">{{ $paket->soals->count() ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Durasi</span>
                        <span class="font-semibold text-gray-900">{{ $paket->durasi ?? 0 }} menit</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="font-semibold {{ ($paket->status ?? 'aktif') === 'aktif' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($paket->status ?? 'aktif') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Dibuat</span>
                        <span class="font-semibold text-gray-900">{{ $paket->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.paket.edit', $paket->id) }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2 border border-amber-300 rounded-lg text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Paket
                    </a>
                    <a href="{{ route('admin.soal.create', ['paket_id' => $paket->id]) }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2 border border-purple-300 rounded-lg text-sm font-medium text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Soal
                    </a>
                    <a href="{{ route('tryout.mulai', $paket->id) }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M19 10a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Preview Tryout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
