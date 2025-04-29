<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';

    public function kegiatan_magang(): BelongsTo
    {
        return $this->belongsTo(KegiatanMagang::class, 'id_kegiatan_magang', 'id_kegiatan_magang');
    }
}
