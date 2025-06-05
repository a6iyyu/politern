<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DurasiMagang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'durasi_magang';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_durasi_magang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_durasi',
        'lama_bulan',
        'keterangan',
    ];

    /**
     * Get all of the preferensi for the durasi magang.
     */
    public function preferensiMahasiswa(): HasMany
    {
        return $this->hasMany(PreferensiDurasiMahasiswa::class, 'id_durasi_magang', 'id_durasi_magang');
    }
}
