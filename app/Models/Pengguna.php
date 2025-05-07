<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticable;

class Pengguna extends Authenticable
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = ['nama_pengguna', 'email', 'kata_sandi', 'tipe'];

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id_pengguna', 'id_pengguna');
    }

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'id_pengguna', 'id_pengguna');
    }
}