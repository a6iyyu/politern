<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreferensiLokasiMagang extends Model
{
    use HasFactory;

    protected $table = 'preferensi_lokasi_magang';
    public $incrementing = false;
    protected $keyType = 'array';
    public $timestamps = true;
    protected $fillable = ['id_mahasiswa', 'id_lokasi'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id_lokasi');
    }
}