<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeriodeMagang extends Model
{
    protected $table = 'periode_magang';
    protected $primaryKey = 'id_periode';
    public $timestamps = true;
    protected $fillable = ['nama_periode', 'tanggal_mulai', 'tanggal_selesai', 'semester', 'durasi'];

    public function durasi(): BelongsTo
    {
        return $this->belongsTo(DurasiMagang::class, 'id_durasi_magang', 'id_durasi_magang');
    }

    public function lowongan(): HasMany
    {
        return $this->hasMany(LowonganMagang::class, 'id_periode', 'id_periode');
    }
}