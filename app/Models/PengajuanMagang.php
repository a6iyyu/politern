<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanMagang extends Model
{
    protected $table = 'pengajuan_magang';
    protected $primaryKey = 'id_pengajuan_magang';

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function lowongan_magang(): BelongsTo
    {
        return $this->belongsTo(LowonganMagang::class, 'id_lowongan', 'id_lowongan');
    }

    public function dosen_pembimbing(): BelongsTo
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dosen_pembimbing', 'id_dosen_pembimbing');
    }
}