<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Paket;

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
        // Validasi input awal tanpa filter dulu
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'pertanyaan' => 'required|string',
            'pilihan' => 'required|array|min:4|max:5',
            'pilihan.*' => 'required|string',
            'jawaban_benar' => 'required|string',
            'pembahasan' => 'nullable|string',
        ]);

        // Filter pilihan kosong, hapus yang kosong
        $filteredPilihan = array_filter($request->pilihan, fn($item) => trim($item) !== '');

        if (count($filteredPilihan) < 4) {
            return back()->withErrors(['pilihan' => 'Minimal 4 pilihan harus diisi'])->withInput();
        }

        // Validasi jawaban benar harus di antara pilihan yang tersedia
        $validOptions = ['A', 'B', 'C', 'D', 'E'];
        $maxIndex = count($filteredPilihan) - 1;
        $validOptions = array_slice($validOptions, 0, $maxIndex + 1);

        if (!in_array($request->jawaban_benar, $validOptions)) {
            return back()->withErrors(['jawaban_benar' => 'Jawaban benar harus salah satu dari pilihan yang tersedia'])->withInput();
        }

        // Prepare data untuk simpan
        $pilihanKeys = ['pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'];
        $data = [
            'paket_id' => $request->paket_id,
            'pertanyaan' => $request->pertanyaan,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan' => $request->pembahasan,
        ];

        foreach ($filteredPilihan as $index => $value) {
            $data[$pilihanKeys[$index]] = $value;
        }

        // Jika pilihan kurang dari 5, pastikan sisanya diisi null agar migration valid
        for ($i = count($filteredPilihan); $i < 5; $i++) {
            $data[$pilihanKeys[$i]] = null;
        }

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
            'pertanyaan' => 'required|string',
            'pilihan' => 'required|array|min:4|max:5',
            'pilihan.*' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D,E',
            'pembahasan' => 'nullable|string',
        ]);

        $soal = Soal::findOrFail($id);

        $data = [
            'paket_id' => $request->paket_id,
            'pertanyaan' => $request->pertanyaan,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan' => $request->pembahasan,
        ];

        $pilihanKeys = ['pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'];
        foreach ($request->pilihan as $index => $value) {
            $data[$pilihanKeys[$index]] = $value;
        }

        $soal->update($data);

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil diupdate!');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();
        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}
