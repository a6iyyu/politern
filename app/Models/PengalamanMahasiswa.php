<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengalamanMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_mahasiswa';
    protected $fillable = ['id_mahasiswa', 'id_pengalaman'];
    public $timestamps = false;

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function pengalaman(): BelongsTo
    {
        return $this->belongsTo(Pengalaman::class, 'id_pengalaman', 'id_pengalaman');
    }
}