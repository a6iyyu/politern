<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Magang extends Model
{
    use HasFactory;

    protected $table = 'magang';
    protected $primaryKey = 'id_magang';
    protected $fillable = ['id_pengajuan_magang', 'id_dosen_pembimbing', 'status'];

    public function pengajuan_magang(): BelongsTo
    {
        return $this->belongsTo(PengajuanMagang::class, 'id_pengajuan_magang');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen_pembimbing(): BelongsTo
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dosen_pembimbing');
    }
}