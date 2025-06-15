<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke hasil tryout
    public function hasilTryout()
    {
        return $this->hasMany(HasilTryout::class);
    }

    // Relasi ke jawaban user
    public function jawabanUser()
    {
        return $this->hasMany(JawabanUser::class);
    }
}
