<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';
    protected $fillable = ['id_magang', 'judul', 'minggu', 'deskripsi', 'foto', 'status', 'komentar', 'tanggal_evaluasi'];

    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'id_magang', 'id_magang');
    }
}