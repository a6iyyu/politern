<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisLokasi extends Model
{
    use HasFactory;

    protected $table = 'jenis_lokasi';
    protected $primaryKey = 'id_jenis_lokasi';
    protected $fillable = ['nama_jenis_lokasi'];
    public $timestamps = false;

    public function lowongan_magang(): HasMany
    {
        return $this->hasMany(LowonganMagang::class, 'id_jenis_lokasi', 'id_jenis_lokasi');
    }
}