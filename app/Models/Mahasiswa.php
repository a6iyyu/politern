<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'id_pengguna', 'nama_lengkap', 'nim', 'semester', 'id_prodi', 'angkatan', 'ipk', 'status'
    ];

    public function bidang(): BelongsToMany
    {
        return $this->belongsToMany(Bidang::class, 'bidang_mahasiswa', 'id_mahasiswa', 'id_bidang');
    }

    public function lokasi(): BelongsToMany
    {
        return $this->belongsToMany(Lokasi::class, 'preferensi_lokasi_magang', 'id_mahasiswa', 'id_lokasi');
    }

    public function keahlian(): BelongsToMany
    {
        return $this->belongsToMany(Keahlian::class, 'keahlian_mahasiswa', 'id_mahasiswa', 'id_keahlian');
    }

    public function pengajuan_magang(): HasMany
    {
        return $this->hasMany(PengajuanMagang::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function program_studi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id_prodi');
    }
}