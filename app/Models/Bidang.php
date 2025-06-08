<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang';
    protected $primaryKey = 'id_bidang';
    protected $fillable = ['nama_bidang'];
    public $timestamps = false;

    public function lowongan(): HasMany
    {
        return $this->hasMany(LowonganMagang::class, 'id_bidang', 'id_bidang');
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'bidang_mahasiswa', 'id_bidang', 'id_mahasiswa');
    }
}