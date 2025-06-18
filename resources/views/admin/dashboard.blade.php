@extends('layouts.app')

@section('title', 'Dashboard Admin Tryout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="text-gray-600 mt-2">Kelola konten tryout dengan mudah dan profesional</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-green-700">System Online</span>
                    </div>
                </div>
                <div class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-700">{{ now()->format('H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $stats = [
                [
                    'title' => 'Total Paket',
                    'count' => \App\Models\Paket::count(),
                    'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                    'color' => 'blue',
                    'bgColor' => 'bg-blue-50',
                    'textColor' => 'text-blue-600',
                    'route' => 'admin.paket.index'
                ],
                [
                    'title' => 'Total Soal',
                    'count' => \App\Models\Soal::count(),
                    'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'emerald',
                    'bgColor' => 'bg-emerald-50',
                    'textColor' => 'text-emerald-600',
                    'route' => 'admin.soal.index'
                ],
                [
                    'title' => 'Pengguna Aktif',
                    'count' => \App\Models\User::where('created_at', '>=', now()->subDays(30))->count(),
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
                    'color' => 'purple',
                    'bgColor' => 'bg-purple-50',
                    'textColor' => 'text-purple-600',
                    'route' => 'admin.users.index'
                ],
                [
                    'title' => 'Tryout Hari Ini',
                    'count' => \App\Models\HasilTryout::whereDate('created_at', today())->count() ?? 0,
                    'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    'color' => 'amber',
                    'bgColor' => 'bg-amber-50',
                    'textColor' => 'text-amber-600',
                    'route' => 'admin.hasil.index'
                ]
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all duration-200 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stat['count']) }}</p>
                        <div class="mt-2">
                            <a href="{{ route($stat['route']) }}" class="{{ $stat['textColor'] }} hover:underline text-sm font-medium inline-flex items-center group-hover:translate-x-1 transition-transform">
                                Kelola
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="w-12 h-12 {{ $stat['bgColor'] }} rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 {{ $stat['textColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path>
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Aksi Cepat
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $quickActions = [
                            [
                                'title' => 'Buat Paket Baru',
                                'description' => 'Tambah paket tryout baru',
                                'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
                                'color' => 'blue',
                                'bgColor' => 'bg-blue-50',
                                'hoverBg' => 'hover:bg-blue-100',
                                'textColor' => 'text-blue-600',
                                'hoverText' => 'group-hover:text-blue-700',
                                'route' => 'admin.paket.create'
                            ],
                            [
                                'title' => 'Tambah Soal',
                                'description' => 'Buat soal tryout baru',
                                'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                                'color' => 'emerald',
                                'bgColor' => 'bg-emerald-50',
                                'hoverBg' => 'hover:bg-emerald-100',
                                'textColor' => 'text-emerald-600',
                                'hoverText' => 'group-hover:text-emerald-700',
                                'route' => 'admin.soal.create'
                            ],
                            [
                                'title' => 'Lihat Hasil',
                                'description' => 'Analisis hasil tryout',
                                'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                                'color' => 'purple',
                                'bgColor' => 'bg-purple-50',
                                'hoverBg' => 'hover:bg-purple-100',
                                'textColor' => 'text-purple-600',
                                'hoverText' => 'group-hover:text-purple-700',
                                'route' => 'admin.hasil.index'
                            ],
                            [
                                'title' => 'Kelola Pengguna',
                                'description' => 'Manajemen pengguna sistem',
                                'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
                                'color' => 'amber',
                                'bgColor' => 'bg-amber-50',
                                'hoverBg' => 'hover:bg-amber-100',
                                'textColor' => 'text-amber-600',
                                'hoverText' => 'group-hover:text-amber-700',
                                'route' => 'admin.users.index'
                            ]
                        ];
                    @endphp

                    @foreach($quickActions as $action)
                        <a href="{{ route($action['route']) }}" class="group p-4 border border-gray-200 rounded-lg hover:border-gray-300 {{ $action['hoverBg'] }} transition-all duration-200">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 {{ $action['bgColor'] }} rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 {{ $action['textColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 {{ $action['hoverText'] }} transition-colors">{{ $action['title'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $action['description'] }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Top Performers / Leaderboard -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            Peringkat Nilai Tertinggi
                        </h2>
                        <a href="{{ route('admin.hasil.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if(isset($top_performers) && count($top_performers) > 0)
                        <div class="space-y-4">
                            @foreach($top_performers as $index => $performer)
                                <div class="flex items-center space-x-4 p-3 {{ $index === 0 ? 'bg-amber-50 border border-amber-200' : 'bg-gray-50' }} rounded-lg">
                                    <div class="flex-shrink-0">
                                        @if($index === 0)
                                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </div>
                                        @elseif($index === 1)
                                            <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">2</span>
                                            </div>
                                        @elseif($index === 2)
                                            <div class="w-8 h-8 bg-amber-600 rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">3</span>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 text-sm font-bold">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $performer['user']->name }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($performer['time'])->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-16 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full transition-all duration-300" style="width: {{ $performer['score'] }}%"></div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900 min-w-0">{{ $performer['score'] }}%</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Belum Ada Data</h3>
                            <p class="text-sm text-gray-500">Belum ada hasil tryout yang tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    </svg>
                    Aktivitas Terbaru
                </h3>
                <div class="space-y-3">
                    @php
                        $recentActivities = [
                            ['action' => 'Paket baru ditambahkan', 'time' => '2 jam lalu', 'type' => 'create', 'color' => 'green'],
                            ['action' => '15 soal baru dibuat', 'time' => '5 jam lalu', 'type' => 'create', 'color' => 'green'],
                            ['action' => 'Pengguna baru terdaftar', 'time' => '1 hari lalu', 'type' => 'user', 'color' => 'blue'],
                            ['action' => 'Tryout diselesaikan', 'time' => '2 hari lalu', 'type' => 'complete', 'color' => 'purple']
                        ];
                    @endphp

                    @foreach($recentActivities as $activity)
                        <div class="flex items-center space-x-3 py-2">
                            <div class="w-2 h-2 bg-{{ $activity['color'] }}-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">{{ $activity['action'] }}</p>
                                <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Status Sistem
                </h3>
                <div class="space-y-3">
                    @php
                        $systemStatus = [
                            ['name' => 'Database', 'status' => 'online', 'color' => 'green'],
                            ['name' => 'Storage', 'status' => 'online', 'color' => 'green'],
                            ['name' => 'Cache', 'status' => 'online', 'color' => 'green'],
                            ['name' => 'Queue', 'status' => 'online', 'color' => 'green']
                        ];
                    @endphp

                    @foreach($systemStatus as $status)
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-700">{{ $status['name'] }}</span>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-{{ $status['color'] }}-500 rounded-full"></div>
                                <span class="text-xs text-{{ $status['color'] }}-600 font-medium capitalize">{{ $status['status'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Statistik Cepat
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Tryout Minggu Ini</span>
                        <span class="font-semibold text-gray-900">{{ \App\Models\HasilTryout::where('created_at', '>=', now()->startOfWeek())->count() ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Rata-rata Skor</span>
                        <span class="font-semibold text-gray-900">{{ number_format(\App\Models\HasilTryout::avg('skor') ?? 0, 1) }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
