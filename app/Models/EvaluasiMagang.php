<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluasiMagang extends Model
{
    protected $table = 'evaluasi_magang';
    protected $primaryKey = 'id_evaluasi';
    protected $fillable = [
        'id_magang', 'tanggal_evaluasi', 'status', 'komentar'
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang');
    }
}