<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Magang extends Model
{
    protected $table = 'magang';
    protected $primaryKey = 'id_magang';
    protected $fillable = [
        'id_pengajuan_magang', 'id_dosen_pembimbing', 'status'
    ];

    public function pengajuan_magang()
    {
        return $this->belongsTo(PengajuanMagang::class, 'id_pengajuan_magang');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id'); // jika dosen login pakai model User
    }
}
