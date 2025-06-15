<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTryout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_id',
        'jumlah_benar',
        'jumlah_salah',
        'skor',
        'waktu_selesai'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
