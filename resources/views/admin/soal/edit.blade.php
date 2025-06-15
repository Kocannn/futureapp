@extends('layouts.app')

@section('title', 'Edit Soal')

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
        <h1 class="text-3xl font-bold text-gray-900">Edit Soal</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi soal tryout</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Informasi Soal
            </h2>
        </div>

        <form action="{{ route('admin.soal.update', $soal->id) }}" method="POST" class="p-6">
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

            <div class="space-y-6">
                <!-- Paket Soal -->
                <div>
                    <label for="paket_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Paket Soal <span class="text-red-500">*</span>
                    </label>
                    <select id="paket_id"
                            name="paket_id"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('paket_id') border-red-300 @enderror">
                        <option value="" disabled>-- Pilih Paket Soal --</option>
                        @foreach($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ old('paket_id', $soal->paket_id) == $paket->id ? 'selected' : '' }}>
                                {{ $paket->nama ?? $paket->judul }}
                            </option>
                        @endforeach
                    </select>
                    @error('paket_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pertanyaan -->
                <div>
                    <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">
                        Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="pertanyaan"
                              name="pertanyaan"
                              rows="4"
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors resize-none @error('pertanyaan') border-red-300 @enderror"
                              placeholder="Masukkan pertanyaan soal...">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilihan Jawaban -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">
                        Pilihan Jawaban <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3">
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
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-sm font-medium text-gray-700">{{ $key }}</span>
                                </div>
                                <div class="flex-1">
                                    <input type="text"
                                           name="pilihan_{{ strtolower($key) }}"
                                           value="{{ old('pilihan_' . strtolower($key), $value) }}"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('pilihan_' . strtolower($key)) border-red-300 @enderror"
                                           placeholder="Masukkan pilihan {{ $key }}">
                                    @error('pilihan_' . strtolower($key))
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Jawaban Benar -->
                <div>
                    <label for="jawaban_benar" class="block text-sm font-medium text-gray-700 mb-2">
                        Jawaban Benar <span class="text-red-500">*</span>
                    </label>
                    <select id="jawaban_benar"
                            name="jawaban_benar"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('jawaban_benar') border-red-300 @enderror">
                        @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                            <option value="{{ $option }}" {{ old('jawaban_benar', $soal->jawaban_benar) == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('jawaban_benar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pembahasan -->
                <div>
                    <label for="pembahasan" class="block text-sm font-medium text-gray-700 mb-2">
                        Pembahasan (Opsional)
                    </label>
                    <textarea id="pembahasan"
                              name="pembahasan"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors resize-none @error('pembahasan') border-red-300 @enderror"
                              placeholder="Tuliskan pembahasan atau penjelasan dari soal ini (opsional)">{{ old('pembahasan', $soal->pembahasan) }}</textarea>
                    @error('pembahasan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Pembahasan akan ditampilkan setelah pengguna menyelesaikan tryout</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-8">
                <a href="{{ route('admin.soal.show', $soal->id) }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-amber-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Soal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
