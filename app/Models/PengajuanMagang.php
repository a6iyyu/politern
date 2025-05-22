<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanMagang extends Model
{
    protected $table = 'pengajuan_magang';
    protected $primaryKey = 'id_pengajuan_magang';
    protected $fillable = [
        'id_mahasiswa', 'id_lowongan', 'tanggal_pengajuan', 'status', 'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function lowongan()
    {
        return $this->belongsTo(LowonganMagang::class, 'id_lowongan');
    }
    public function magang()
    {
        return $this->hasMany(Magang::class, 'id_pengajuan_magang', 'id_pengajuan_magang');
    }
}