<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    public $timestamps = true;
    protected $fillable = ['nip', 'nama', 'nomor_telepon'];

    public function pembimbing(): HasOne
    {
        return $this->hasOne(DosenPembimbing::class, 'id_dosen', 'id_dosen');
    }
}