<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KeahlianMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'keahlian_mahasiswa';
    protected $primaryKey = 'id_keahlian';

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'keahlian_mahasiswa', 'id_keahlian', 'id_mahasiswa');
    }
}