<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    public $timestamps = true;
    protected $fillable = ['id_pengguna', 'nip', 'nama', 'nomor_telepon'];

    public function pembimbing(): HasOne
    {
        return $this->hasOne(DosenPembimbing::class, 'id_dosen', 'id_dosen');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function magang(): HasMany
    {
        return $this->hasMany(Magang::class, 'id_dosen_pembimbing', 'id_dosen');
    }
}