@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid lg:grid-cols-4 gap-8">
        <!-- Main Content Area -->
        <div class="lg:col-span-3">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-3">
                    Pilih Paket Tryout
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl">
                    Siapkan dirimu dengan paket soal terbaik dan lengkap pembahasan untuk meningkatkan kemampuanmu.
                </p>
            </div>


            <!-- Package Cards Grid -->
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($pakets as $paket)
                    @php
                        $colorSchemes = [
                            'blue' => [
                                'bg' => 'bg-blue-50',
                                'border' => 'border-blue-200',
                                'icon' => 'text-blue-600',
                                'button' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
                                'badge' => 'bg-blue-100 text-blue-800'
                            ],
                            'emerald' => [
                                'bg' => 'bg-emerald-50',
                                'border' => 'border-emerald-200',
                                'icon' => 'text-emerald-600',
                                'button' => 'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500',
                                'badge' => 'bg-emerald-100 text-emerald-800'
                            ],
                            'purple' => [
                                'bg' => 'bg-purple-50',
                                'border' => 'border-purple-200',
                                'icon' => 'text-purple-600',
                                'button' => 'bg-purple-600 hover:bg-purple-700 focus:ring-purple-500',
                                'badge' => 'bg-purple-100 text-purple-800'
                            ],
                            'amber' => [
                                'bg' => 'bg-amber-50',
                                'border' => 'border-amber-200',
                                'icon' => 'text-amber-600',
                                'button' => 'bg-amber-600 hover:bg-amber-700 focus:ring-amber-500',
                                'badge' => 'bg-amber-100 text-amber-800'
                            ],
                            'rose' => [
                                'bg' => 'bg-rose-50',
                                'border' => 'border-rose-200',
                                'icon' => 'text-rose-600',
                                'button' => 'bg-rose-600 hover:bg-rose-700 focus:ring-rose-500',
                                'badge' => 'bg-rose-100 text-rose-800'
                            ]
                        ];

                        $colorNames = array_keys($colorSchemes);
                        $colorIndex = $loop->index % count($colorNames);
                        $currentScheme = $colorSchemes[$colorNames[$colorIndex]];
                    @endphp

                    <article class="group bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg hover:border-gray-300 transition-all duration-300 hover:-translate-y-1">
                        <!-- Card Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 {{ $currentScheme['bg'] }} {{ $currentScheme['border'] }} border rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 {{ $currentScheme['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-900 group-hover:text-gray-700 transition-colors truncate">
                                        {{ $paket->judul }}
                                    </h2>
                                </div>
                            </div>

                            @if($paket->is_new ?? false)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $currentScheme['badge'] }} flex-shrink-0">
                                    Terbaru
                                </span>
                            @endif
                        </div>

<!-- Card Description -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ $paket->deskripsi ?? 'Soal-soal terbaru, lengkap dengan pembahasan yang mudah dipahami untuk meningkatkan kemampuan dan pemahaman materi.' }}
                        </p>

                        <!-- Card Footer -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                                <span>{{ $paket->durasi ?? '90' }} menit</span>
                            </div>

                            @php
                                $attemptCount = $attemptCounts[$paket->id] ?? 0;
                                $attemptsLeft = 3 - $attemptCount;
                            @endphp

                            @if($attemptsLeft > 0)
                                <a href="{{ route('tryout.mulai', ['id' => $paket->id]) }}"
                                   class="inline-flex items-center px-4 py-2 {{ $currentScheme['button'] }} text-white text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M19 10a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Kerjakan ({{ $attemptsLeft }} sisa)
                                </a>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-600 text-sm font-medium rounded-lg cursor-not-allowed">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Batas Tercapai
                                </span>
                            @endif
                        </div>
                    </article>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full">
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                Belum Ada Paket Soal
                            </h3>
                            <p class="text-gray-500 max-w-sm mx-auto">
                                Paket soal tryout akan segera tersedia. Silakan cek kembali dalam beberapa saat.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-8 space-y-6">
<div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm text-gray-600">Total Paket</span>
                            <span class="font-semibold text-gray-900 bg-gray-50 px-2 py-1 rounded-md text-sm">
                                {{ count($pakets) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm text-gray-600">Paket Terbaru</span>
                            <span class="font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-md text-sm">
                                {{ $pakets->where('is_new', true)->count() ?? 0 }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm text-gray-600">Tersedia</span>
                            <span class="font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md text-sm">
                                {{ count($pakets) > 0 ? 'Aktif' : 'Segera' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-gray-600">Batas Percobaan</span>
                            <span class="font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-md text-sm">
                                3 kali per paket
                            </span>
                        </div>
                <!-- Motivation Card -->
                <div class="bg-gradient-to-br from-blue-50 via-blue-50 to-indigo-100 rounded-2xl p-6 text-center border border-blue-100">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Tingkatkan Kemampuan
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Uji kemampuanmu dan tingkatkan skor dengan latihan yang konsisten setiap hari.
                    </p>
                </div>
                <!-- History Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Riwayat Tryout
                    </h4>
                    <div class="flex space-x-2">
                        <a href="{{ route('tryout.history') }}" class="flex-1 py-2 px-3 bg-purple-50 hover:bg-purple-100 text-purple-700 font-medium rounded-lg text-center transition duration-200">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Statistik Tryout
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm text-gray-600">Total Paket</span>
                            <span class="font-semibold text-gray-900 bg-gray-50 px-2 py-1 rounded-md text-sm">
                                {{ count($pakets) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                            <span class="text-sm text-gray-600">Paket Terbaru</span>
                            <span class="font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-md text-sm">
                                {{ $pakets->where('is_new', true)->count() ?? 0 }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-gray-600">Tersedia</span>
                            <span class="font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md text-sm">
                                {{ count($pakets) > 0 ? 'Aktif' : 'Segera' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Tips Sukses
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Baca soal dengan teliti
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Kelola waktu dengan baik
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Pelajari pembahasan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
