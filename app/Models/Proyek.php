<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';
    protected $primaryKey = 'id_proyek';
    protected $fillable = ['nama_proyek', 'peran', 'deskripsi', 'tautan', 'alat', 'tanggal_mulai', 'tanggal_selesai'];

    protected $casts = [
        'alat' => 'array'
    ];

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'proyek_mahasiswa', 'id_proyek', 'id_mahasiswa');
    }
}