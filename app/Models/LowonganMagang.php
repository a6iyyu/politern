<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LowonganMagang extends Model
{
    use HasFactory;

    protected $table = 'lowongan_magang';
    protected $primaryKey = 'id_lowongan';
    protected $fillable = [
        'id_perusahaan_mitra',
        'id_keahlian',
        'id_bidang',
        'id_periode',
        'id_jenis_lokasi',
        'judul',
        'deskripsi',
        'kategori',
        'lokasi',
        'bidang_keahlian',
        'kuota',
        'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran',
        'tanggal_posting',
        'status',
        'nama',
        'nama_bidang',
        'nama_keahlian',
        'durasi',
        'nama_jenis_lokasi',
        'dekripsi',
        'gaji',
        'nilai_minimal',
        'kuota'
    ];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }

    public function jenis_lokasi(): BelongsTo
    {
        return $this->belongsTo(JenisLokasi::class, 'id_jenis_lokasi', 'id_jenis_lokasi');
    }

    public function periode_magang(): BelongsTo
    {
        return $this->belongsTo(PeriodeMagang::class, 'id_periode', 'id_periode');
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }

    public function keahlian(): BelongsToMany
    {
        return $this->belongsToMany(Keahlian::class, 'keahlian_lowongan', 'id_lowongan', 'id_keahlian');
    }
}