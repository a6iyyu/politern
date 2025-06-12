<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';
    protected $fillable = [
        'id_magang', 
        'judul', 
        'minggu', 
        'deskripsi', 
        'foto', 
        'status', 
        'komentar', 
        'tanggal_evaluasi'
    ];
    
    protected $casts = [
        'tanggal_evaluasi' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function magang(): BelongsTo
    {
        return $this->belongsTo(Magang::class, 'id_magang', 'id_magang');
    }
}