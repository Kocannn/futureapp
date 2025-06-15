@extends('layouts.admin')

@section('title', 'Peringkat Tryout - ' . $paket->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Peringkat: {{ $paket->judul }}</h1>
        <a href="{{ route('admin.peringkat') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-gray-700">
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peringkat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Selesai</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($peringkat as $index => $hasil)
                <tr class="{{ $index < 3 ? 'bg-yellow-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($index === 0)
                            <span class="px-2 py-1 bg-yellow-500 text-white rounded-full">🏆 1</span>
                        @elseif($index === 1)
                            <span class="px-2 py-1 bg-gray-400 text-white rounded-full">🥈 2</span>
                        @elseif($index === 2)
                            <span class="px-2 py-1 bg-amber-700 text-white rounded-full">🥉 3</span>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $hasil->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $hasil->skor }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $hasil->waktu_selesai }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data peringkat</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
