<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanMagang extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_magang';
    protected $primaryKey = 'id_pengajuan_magang';
    protected $fillable = ['id_mahasiswa', 'id_lowongan', 'tanggal_pengajuan', 'status', 'keterangan'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(LowonganMagang::class, 'id_lowongan');
    }
    public function magang(): HasOne
    {
        return $this->hasOne(Magang::class, 'id_pengajuan_magang', 'id_pengajuan_magang');
    }
}