<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUser extends Model
{
    use HasFactory;

    protected $table = 'jawaban_users';

    protected $fillable = [
        'user_id',
        'paket_id',
        'soal_id',
        'jawaban_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
