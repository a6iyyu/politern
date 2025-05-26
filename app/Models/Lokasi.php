<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    public $timestamps = false;

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'preferensi_lokasi_magang', 'id_lokasi', 'id_mahasiswa');
    }

    public function perusahaan(): HasMany
    {
        return $this->hasMany(Perusahaan::class, 'id_lokasi', 'id_lokasi');
    }
}