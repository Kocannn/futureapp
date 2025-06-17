<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'tables',
        'jawaban_benar',
        'pembahasan'
    ];


    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    // Relasi lain jika ada, contohnya:
    // public function jawabanUsers()
    // {
    //     return $this->hasMany(JawabanUser::class);
    // }
}
