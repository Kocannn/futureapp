@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-3">
                    Pilih Paket Tryout
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Siapkan dirimu dengan paket soal terbaik dan lengkap pembahasan.
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid gap-6 sm:grid-cols-2">
                @forelse ($pakets as $paket)
                    @php
                        $colors = [
                            'blue' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-700', 'button' => 'bg-blue-600 hover:bg-blue-700', 'badge' => 'bg-blue-100 text-blue-800'],
                            'emerald' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-700', 'button' => 'bg-emerald-600 hover:bg-emerald-700', 'badge' => 'bg-emerald-100 text-emerald-800'],
                            'purple' => ['bg' => 'bg-purple-50', 'border' => 'border-purple-200', 'text' => 'text-purple-700', 'button' => 'bg-purple-600 hover:bg-purple-700', 'badge' => 'bg-purple-100 text-purple-800'],
                            'amber' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-700', 'button' => 'bg-amber-600 hover:bg-amber-700', 'badge' => 'bg-amber-100 text-amber-800'],
                            'rose' => ['bg' => 'bg-rose-50', 'border' => 'border-rose-200', 'text' => 'text-rose-700', 'button' => 'bg-rose-600 hover:bg-rose-700', 'badge' => 'bg-rose-100 text-rose-800']
                        ];
                        $colorNames = array_keys($colors);
                        $colorIndex = $loop->index % count($colorNames);
                        $currentColor = $colors[$colorNames[$colorIndex]];
                    @endphp

                    <article class="group bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg hover:border-gray-300 transition-all duration-200">
                        <!-- Card Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 {{ $currentColor['bg'] }} {{ $currentColor['border'] }} border rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 {{ $currentColor['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 group-hover:text-gray-700 transition-colors">
                                        {{ $paket->judul }}
                                    </h2>
                                </div>
                            </div>

                            @if($paket->is_new ?? false)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $currentColor['badge'] }}">
                                    Terbaru
                                </span>
                            @endif
                        </div>

                        <!-- Card Description -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            {{ $paket->deskripsi ?? 'Soal-soal terbaru, lengkap dengan pembahasan yang mudah dipahami.' }}
                        </p>

                        <!-- Card Action -->
                        <a href="{{ route('tryout.mulai', ['id' => $paket->id]) }}"
                           class="inline-flex items-center justify-center w-full px-4 py-2.5 {{ $currentColor['button'] }} text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M19 10a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mulai Kerjakan
                        </a>
                    </article>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Paket Soal</h3>
                            <p class="text-gray-500">Paket soal akan segera tersedia. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Illustration -->
        <div class="lg:col-span-1">
            <div class="sticky top-8">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-8 text-center">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">
                        Tingkatkan Kemampuan
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Uji kemampuanmu dan tingkatkan skor dengan latihan yang konsisten setiap hari.
                    </p>
                    <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Pembahasan Lengkap
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="mt-6 bg-white rounded-xl border border-gray-200 p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Statistik Tryout</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Total Paket</span>
                            <span class="font-semibold text-gray-900">{{ count($pakets) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Paket Terbaru</span>
                            <span class="font-semibold text-gray-900">{{ $pakets->where('is_new', true)->count() ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
