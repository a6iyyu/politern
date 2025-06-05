<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreferensiJenisLokasiMagang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'preferensi_jenis_lokasi_magang';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_preferensi_jenis_lokasi_magang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_mahasiswa',
        'id_jenis_lokasi',
    ];

    /**
     * Get the mahasiswa that owns the preference.
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    /**
     * Get the jenis lokasi that owns the preference.
     */
    public function jenisLokasi(): BelongsTo
    {
        return $this->belongsTo(JenisLokasi::class, 'id_jenis_lokasi', 'id_jenis_lokasi');
    }
}
