<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JenisLokasiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'jenis_lokasi_mahasiswa';
    protected $primaryKey = 'id_jenis_lokasi';

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'preferensi_jenis_lokasi_magang', 'id_jenis_lokasi', 'id_mahasiswa');
    }
}