<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'required|integer|min:1',
        ]);

        Paket::create($request->only(['nama', 'deskripsi', 'durasi']));

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'required|integer|min:1',
        ]);

        $paket->update($request->only(['nama', 'deskripsi', 'durasi']));

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diupdate!');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus!');
    }
    public function show($id)
    {
        $paket = Paket::with('soals')->findOrFail($id);
        return view('admin.paket.show', compact('paket'));
    }
}
