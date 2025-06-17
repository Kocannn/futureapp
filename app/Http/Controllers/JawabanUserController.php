<?php

namespace App\Http\Controllers;

use App\Models\JawabanUser;
use Illuminate\Http\Request;

class JawabanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasil = HasilTryout::with('user', 'paket', 'jawabans.soal')->get();

        return view('admin.hasil.index', compact('hasil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JawabanUser $jawabanUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JawabanUser $jawabanUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JawabanUser $jawabanUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JawabanUser $jawabanUser)
    {
        //
    }

    public function jawabans()
    {
        return $this->hasMany(JawabanUser::class, 'paket_id', 'paket_id')->where('user_id', $this->user_id);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
