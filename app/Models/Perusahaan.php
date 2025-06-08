<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_mitra';
    protected $primaryKey = 'id_perusahaan_mitra';

    protected $fillable = ['id_lokasi', 'nama', 'nib', 'nomor_telepon', 'email', 'website', 'status', 'logo'];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id_lokasi');
    }
}