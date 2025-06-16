@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-3">
            Riwayat Tryout
        </h1>
        <p class="text-lg text-gray-600 leading-relaxed max-w-2xl">
            Lihat hasil dari semua percobaan tryout yang sudah kamu kerjakan.
        </p>
    </div>

    @if($results->count() > 0)
        <div class="space-y-8">
            @foreach($results as $paketId => $paketResults)
                @php $paket = $paketResults->first()->paket; @endphp
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $paket->judul }}</h2>
                        <p class="text-sm text-gray-600">{{ $attemptCounts[$paketId] ?? 0 }} percobaan</p>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @foreach($paketResults as $index => $hasil)
                            <div class="p-6 flex items-center justify-between">
                                <div>
                                    <span class="font-medium text-gray-900">Percobaan #{{ $index + 1 }}</span>
                                    <div class="text-sm text-gray-500">{{ $hasil->created_at->format('d M Y, H:i') }}</div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="text-right">
                                        <div class="font-semibold text-lg">Skor: {{ $hasil->skor }}</div>
                                        <div class="text-sm text-gray-500">Durasi: {{ $hasil->durasi_menit ?? '-' }} menit</div>
                                    </div>

                                    <a href="{{ route('tryout.hasil', $hasil->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                Belum Ada Riwayat
            </h3>
            <p class="text-gray-500 max-w-sm mx-auto">
                Kamu belum mengerjakan tryout apapun. Kerjakan tryout untuk melihat hasilnya di sini.
            </p>
        </div>
    @endif
</div>
@endsection
