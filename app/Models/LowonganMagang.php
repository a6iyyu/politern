<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LowonganMagang extends Model
{
    protected $table = 'lowongan_magang';
    protected $primaryKey = 'id_lowongan';
    protected $fillable = [
        'id_perusahaan_mitra', 'id_periode', 'judul', 'deskripsi', 'kategori',
        'lokasi', 'bidang_keahlian', 'kuota', 'tanggal_mulai_pendaftaran',
        'tanggal_selesai_pendaftaran', 'tanggal_posting', 'status'
    ];

    public function periode_magang(): BelongsTo
    {
        return $this->belongsTo(PeriodeMagang::class, 'id_periode', 'id_periode');
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }
}