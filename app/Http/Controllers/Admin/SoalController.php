<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $soals = Soal::all();

        return view('admin.soal.index', compact('soals'));
    }

    public function create()
    {
        $paketSoals = Paket::all();

        return view('admin.soal.create', compact('paketSoals'));
    }

    public function store(Request $request)
    {
        // Validasi input awal
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'pertanyaan' => 'required',  // Removed string validation to allow HTML content
            'pilihan' => 'required|array|min:4|max:5',
            'pilihan.*' => 'required|string',
            'jawaban_benar' => 'required|string',
            'pembahasan' => 'nullable',
            'table_headers' => 'nullable|string',
            'table_rows' => 'nullable|string',
        ]);

        // Proses data tabel jika ada
        $tableData = null;
        if ($request->filled('table_headers') || $request->filled('table_rows')) {
            // Parse headers
            $headers = array_map('trim', explode(',', $request->table_headers));

            // Parse rows
            $rows = collect(explode("\n", $request->table_rows))
                ->filter(function ($row) {
                    return ! empty(trim($row));
                })
                ->map(function ($row) {
                    return array_map('trim', explode(',', $row));
                })
                ->toArray();

            // Buat struktur JSON tabel
            $tableData = [
                'headers' => $headers,
                'rows' => $rows,
            ];
        }

        // Prepare data untuk simpan
        $data = [
            'paket_id' => $request->paket_id,
            'pertanyaan' => $request->pertanyaan,
            'tables' => $tableData ? json_encode($tableData) : null,
            'pilihan_a' => $request->pilihan[0] ?? null,
            'pilihan_b' => $request->pilihan[1] ?? null,
            'pilihan_c' => $request->pilihan[2] ?? null,
            'pilihan_d' => $request->pilihan[3] ?? null,
            'pilihan_e' => $request->pilihan[4] ?? null,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan' => $request->pembahasan,
        ];

        Soal::create($data);

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function show($id)
    {
        $soal = Soal::findOrFail($id);

        return view('admin.soal.show', compact('soal'));
    }

    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        $pakets = Paket::all();  // Adding this line to pass $pakets to the view

        return view('admin.soal.edit', compact('soal', 'pakets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'pertanyaan' => 'required',  // Removed string validation to allow HTML content
            'pilihan' => 'required|array|min:4|max:5',
            'pilihan.*' => 'required|string',
            'jawaban_benar' => 'required|string',
            'pembahasan' => 'nullable',
            'table_headers' => 'nullable|string',
            'table_rows' => 'nullable|string',
        ]);

        $soal = Soal::findOrFail($id);

        // Proses data tabel jika ada
        $tableData = null;
        if ($request->filled('table_headers') || $request->filled('table_rows')) {
            // Parse headers
            $headers = array_map('trim', explode(',', $request->table_headers));

            // Parse rows
            $rows = collect(explode("\n", $request->table_rows))
                ->filter(function ($row) {
                    return ! empty(trim($row));
                })
                ->map(function ($row) {
                    return array_map('trim', explode(',', $row));
                })
                ->toArray();

            // Buat struktur JSON tabel
            $tableData = [
                'headers' => $headers,
                'rows' => $rows,
            ];
        }

        // Update data soal termasuk tabel
        $data = $request->except(['_token', '_method', 'table_headers', 'table_rows']);
        $data['tables'] = $tableData ? json_encode($tableData) : null;

        $soal->update($data);

        return redirect()->route('admin.soal.show', $soal->id)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}
