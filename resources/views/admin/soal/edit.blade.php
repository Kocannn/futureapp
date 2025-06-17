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
<!-- Tabel Data -->
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-4">
    <h3 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
        Tabel Data (opsional)
    </h3>

    <div class="space-y-3">
        @php
            $tableData = !empty($soal->tables) ? json_decode($soal->tables, true) : null;
            $headers = isset($tableData['headers']) ? implode(', ', $tableData['headers']) : '';
            $rows = '';
            if (isset($tableData['rows'])) {
                foreach ($tableData['rows'] as $row) {
                    $rows .= implode(', ', $row) . "\n";
                }
            }
        @endphp

        <div>
            <label for="table_headers" class="block text-xs font-medium text-gray-500 mb-1">
                Header Tabel (pisahkan dengan koma)
            </label>
            <input type="text"
                   id="table_headers"
                   name="table_headers"
                   value="{{ old('table_headers', $headers) }}"
                   placeholder="contoh: Tahun, Produksi, Persentase"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
        </div>

        <div>
            <label for="table_rows" class="block text-xs font-medium text-gray-500 mb-1">
                Isi Baris (satu baris per baris, kolom dipisahkan koma)
            </label>
            <textarea id="table_rows"
                      name="table_rows"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 font-mono"
                      placeholder="2023, 500, 25%&#10;2024, 650, 30%">{{ old('table_rows', $rows) }}</textarea>
        </div>

        <div>
            <button type="button"
                    id="preview-table-btn"
                    class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-1 px-3 rounded-md transition-colors">
                Preview Tabel
            </button>
        </div>

        <div id="table-preview-container" class="hidden mt-2 border border-gray-200 rounded-lg overflow-hidden">
            <div class="bg-white p-3 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300" id="table-preview">
                    <thead class="bg-gray-50"></thead>
                    <tbody class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Pertanyaan -->
<div>
    <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">
        Pertanyaan <span class="text-red-500">*</span>
    </label>
    <div class="mb-2 flex justify-between items-center">
        <div class="flex space-x-2">
            <button id="add-table-btn" type="button" class="inline-flex items-center text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-1 px-2 rounded-md transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                Tambah Tabel
            </button>
        </div>
    </div>
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
                           name="pilihan[]"
                           value="{{ old('pilihan.' . ($loop->index), $value) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('pilihan.' . $loop->index) border-red-300 @enderror"
                           placeholder="Masukkan pilihan {{ $key }}">
                    @error('pilihan.' . $loop->index)
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Table Modal Elements
    const tableModal = document.getElementById('table-modal');
    const closeTableModal = document.getElementById('close-table-modal');
    const addTableBtn = document.getElementById('add-table-btn');
    const generateTableBtn = document.getElementById('generate-table-btn');
    const insertTableBtn = document.getElementById('insert-table-btn');
    const tableRows = document.getElementById('table-rows');
    const tableCols = document.getElementById('table-cols');
    const tablePreviewBody = document.getElementById('table-preview-body');
    const pertanyaanTextarea = document.getElementById('pertanyaan');

    // Open Modal when Add Table button is clicked
    if (addTableBtn) {
        addTableBtn.addEventListener('click', function() {
            tableModal.classList.remove('hidden');
            tableModal.classList.add('flex');
            generateTablePreview();
        });
    }

    // Close Modal
    if (closeTableModal) {
        closeTableModal.addEventListener('click', function() {
            tableModal.classList.add('hidden');
            tableModal.classList.remove('flex');
        });
    }

    // Generate Table Preview
    if (generateTableBtn) {
        generateTableBtn.addEventListener('click', generateTablePreview);
    }

    function generateTablePreview() {
        const rows = parseInt(tableRows.value) || 3;
        const cols = parseInt(tableCols.value) || 3;

        tablePreviewBody.innerHTML = '';

        // Add header row
        const headerRow = document.createElement('tr');
        headerRow.className = 'bg-gray-50';

        for (let j = 0; j < cols; j++) {
            const th = document.createElement('th');
            th.className = 'border border-gray-300 p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider';
            th.contentEditable = true;
            th.innerText = `Header ${j+1}`;
            headerRow.appendChild(th);
        }
        tablePreviewBody.appendChild(headerRow);

        // Add data rows
        for (let i = 0; i < rows; i++) {
            const tr = document.createElement('tr');
            tr.className = 'bg-white';

            for (let j = 0; j < cols; j++) {
                const td = document.createElement('td');
                td.className = 'border border-gray-300 p-2';
                td.contentEditable = true;
                td.innerText = `Data ${i+1},${j+1}`;
                tr.appendChild(td);
            }

            tablePreviewBody.appendChild(tr);
        }
    }

    // Insert table to textarea
    if (insertTableBtn) {
        insertTableBtn.addEventListener('click', function() {
            const table = document.createElement('table');
            table.className = 'min-w-full border border-gray-300 mb-4';
            table.innerHTML = tablePreviewBody.parentElement.innerHTML;

            const tableHTML = `<div class="overflow-x-auto my-4">${table.outerHTML}</div>`;

            // Insert at current cursor position or at the beginning
            const cursorPosition = pertanyaanTextarea.selectionStart || 0;
            const textBefore = pertanyaanTextarea.value.substring(0, cursorPosition);
            const textAfter = pertanyaanTextarea.value.substring(cursorPosition);
            pertanyaanTextarea.value = textBefore + tableHTML + textAfter;

            // Close the modal
            tableModal.classList.add('hidden');
            tableModal.classList.remove('flex');
        });
    }

    // Initialize
    if (tablePreviewBody) {
        generateTablePreview();
    }
});
</script>
@endsection

<!-- Table Modal -->
<div id="table-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md mx-4 w-full">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Buat Tabel</h3>
            <button type="button" id="close-table-modal" class="text-gray-400 hover:text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="table-rows" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Baris</label>
                    <input type="number" id="table-rows" min="1" max="10" value="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="table-cols" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Kolom</label>
                    <input type="number" id="table-cols" min="1" max="10" value="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div id="table-preview" class="border border-gray-200 rounded-lg p-4 overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <tbody id="table-preview-body"></tbody>
                </table>
            </div>

            <div class="flex justify-between">
                <button type="button" id="generate-table-btn" class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Perbarui Tampilan
                </button>
                <button type="button" id="insert-table-btn" class="px-3 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Masukkan Tabel
                </button>
            </div>
        </div>
    </div>
</div>
