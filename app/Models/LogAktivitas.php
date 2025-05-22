<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = ['id_log', 'id_magang'];

    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'id_magang', 'id_magang');
    }
}