<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanMagang extends Model
{
    protected $table = 'kegiatan_magang';
    protected $primaryKey = 'id_kegiatan_magang';

    public function pengajuan_magang(): BelongsTo
    {
        return $this->belongsTo(PengajuanMagang::class, 'id_pengajuan', 'id_pengajuan_magang');
    }
    
    public function periode_magang(): BelongsTo
    {
        return $this->belongsTo(PeriodeMagang::class, 'id_periode', 'id_periode');
    }

    public function dosen_pembimbing(): BelongsTo
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dosen_pembimbing', 'id_dosen_pembimbing');
    }
}
