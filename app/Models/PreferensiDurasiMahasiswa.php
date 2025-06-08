<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreferensiDurasiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'preferensi_durasi_mahasiswa';
    public $incrementing = false;
    protected $keyType = 'array';
    public $timestamps = true;
    protected $fillable = ['id_mahasiswa', 'id_durasi_magang'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function durasiMagang(): BelongsTo
    {
        return $this->belongsTo(DurasiMagang::class, 'id_durasi_magang', 'id_durasi_magang');
    }
}