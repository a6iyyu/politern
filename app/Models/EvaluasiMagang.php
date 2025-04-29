<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluasiMagang extends Model
{
    protected $table = 'evaluasi_magang';
    protected $primaryKey = 'id_evaluasi';

    public function pengajuan_magang(): BelongsTo

    {
        return $this->belongsTo(PengajuanMagang::class, 'id_pengajuan_magang', 'id_pengajuan_magang');
    }

    public function dosen_pembimbing(): BelongsTo
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dosen_pembimbing', 'id_dosen_pembimbing');
    }
}