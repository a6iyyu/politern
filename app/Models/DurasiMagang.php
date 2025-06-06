<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DurasiMagang extends Model
{
    protected $table = 'durasi_magang';
    protected $primaryKey = 'id_durasi';
    
    protected $fillable = [
        'nama_durasi'
    ];

    public function preferensiMahasiswa(): HasMany
    {
        return $this->hasMany(PreferensiDurasiMahasiswa::class, 'id_durasi_magang', 'id_durasi_magang');
    }
}
