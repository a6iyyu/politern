<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DurasiMagang extends Model
{
    use HasFactory;

    protected $table = 'durasi_magang';
    protected $primaryKey = 'id_durasi';
    protected $fillable = ['nama_durasi'];

    public function lowongan(): HasMany
    {
        return $this->hasMany(LowonganMagang::class, 'id_durasi_magang', 'id_durasi_magang');
    }

    public function periode(): HasMany
    {
        return $this->hasMany(PeriodeMagang::class, 'id_durasi_magang', 'id_durasi_magang');
    }

    public function preferensi_mahasiswa(): HasMany
    {
        return $this->hasMany(PreferensiDurasiMahasiswa::class, 'id_durasi_magang', 'id_durasi_magang');
    }
}