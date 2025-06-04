<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pengalaman extends Model
{
    use HasFactory;

    protected $table = 'pengalaman';
    protected $primaryKey = 'id_pengalaman';
    protected $fillable = ['posisi', 'nama_lembaga', 'jenis_pengalaman', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'bukti_pendukung'];

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'pengalaman_mahasiswa', 'id_pengalaman', 'id_mahasiswa');
    }
}