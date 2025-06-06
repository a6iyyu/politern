<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SertifikasiPelatihan extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi_pelatihan';
    protected $primaryKey = 'id_sertifikasi_pelatihan';
    protected $fillable = ['nama_sertifikasi_pelatihan', 'nama_lembaga', 'deskripsi', 'tanggal_diterbitkan', 'tanggal_kedaluwarsa', 'bukti_pendukung'];

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'sertifikasi_pelatihan_mahasiswa', 'id_sertifikasi_pelatihan', 'id_mahasiswa');
    }
}