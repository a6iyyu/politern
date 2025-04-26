<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = ['nama_pengguna', 'kata_sandi'];

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id_pengguna', 'id_pengguna');
    }

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'id_pengguna', 'id_pengguna');
    }

    public function perusahaan(): HasOne
    {
        return $this->hasOne(Perusahaan::class, 'id_pengguna', 'id_pengguna');
    }
}