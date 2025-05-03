<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LowonganMagang extends Model
{
    protected $table = 'lowongan_magang';
    protected $primaryKey = 'id_lowongan';

    public function periode_magang(): BelongsTo
    {
        return $this->belongsTo(PeriodeMagang::class, 'id_periode', 'id_periode');
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }
}