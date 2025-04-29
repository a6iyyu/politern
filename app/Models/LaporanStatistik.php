<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanStatistik extends Model
{
    protected $table = 'laporan_statistik';
    protected $primaryKey = 'id_laporan';

    public function periode_magang(): BelongsTo
    {
        return $this->belongsTo(PeriodeMagang::class, 'id_periode', 'id_periode');
    }
}
