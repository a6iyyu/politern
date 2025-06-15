<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreferensiJenisLokasiMagang extends Model
{
    use HasFactory;

    protected $table = 'preferensi_jenis_lokasi_magang';
    protected $primaryKey = 'id_preferensi_jenis_lokasi_magang';
    protected $fillable = ['id_mahasiswa', 'id_jenis_lokasi'];
    public $timestamps = false;

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function jenisLokasi(): BelongsTo
    {
        return $this->belongsTo(JenisLokasi::class, 'id_jenis_lokasi', 'id_jenis_lokasi');
    }
}