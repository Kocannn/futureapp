@extends('layouts.app')

@section('title', 'Edit Paket Soal')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('admin.paket.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
            <div class="h-6 w-px bg-gray-300"></div>
            <a href="{{ route('admin.paket.show', $paket->id) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Lihat Detail
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Paket Soal</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi paket soal "{{ $paket->nama ?? $paket->judul }}"</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Informasi Paket
            </h2>
        </div>

        <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Nama Paket -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Paket <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="nama"
                               name="nama"
                               value="{{ old('nama', $paket->nama ?? $paket->judul) }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('nama') border-red-300 @enderror"
                               placeholder="Masukkan nama paket soal">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durasi -->
                    <div>
                        <label for="durasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Durasi (menit) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number"
                                   id="durasi"
                                   name="durasi"
                                   value="{{ old('durasi', $paket->durasi) }}"
                                   required
                                   min="1"
                                   max="300"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('durasi') border-red-300 @enderror"
                                   placeholder="90">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">menit</span>
                            </div>
                        </div>
                        @error('durasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Durasi pengerjaan tryout (1-300 menit)</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Paket
                        </label>
                        <select id="status"
                                name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                            <option value="aktif" {{ old('status', $paket->status ?? 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $paket->status) === 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Status ketersediaan paket untuk pengguna</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  rows="6"
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors resize-none @error('deskripsi') border-red-300 @enderror"
                                  placeholder="Masukkan deskripsi paket soal...">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Deskripsi akan ditampilkan kepada pengguna</p>
                    </div>

                    <!-- Kategori (Optional) -->
                    <div>
                        <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori (Opsional)
                        </label>
                        <select id="kategori_id"
                                name="kategori_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                            <option value="">Pilih Kategori</option>
                            @if(isset($kategoris))
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $paket->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Pilih kategori untuk mengelompokkan paket</p>
                    </div>

                    <!-- Is New -->
                    <div>
                        <div class="flex items-center">
                            <input id="is_new"
                                   name="is_new"
                                   type="checkbox"
                                   value="1"
                                   {{ old('is_new', $paket->is_new) ? 'checked' : '' }}
                                   class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                            <label for="is_new" class="ml-2 block text-sm text-gray-700">
                                Tandai sebagai paket baru
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Paket akan ditampilkan dengan badge "Terbaru"</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-8">
                <a href="{{ route('admin.paket.show', $paket->id) }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-amber-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Paket
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
