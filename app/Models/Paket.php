<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets'; // pastikan sesuai dengan nama tabel di database

    protected $fillable = [
        'nama',
        'deskripsi',
        'durasi',
        'kategori', // jika kamu tambahkan kategori pada tabelnya
    ];

    // Relasi ke soal
    public function soals()
    {
        return $this->hasMany(Soal::class, 'paket_id');
    }

    /**
     * Get the hasil tryouts for the paket.
     */
    public function hasilTryouts()
    {
        return $this->hasMany(HasilTryout::class, 'paket_id');
    }
}
