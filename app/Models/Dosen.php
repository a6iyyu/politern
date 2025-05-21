<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    public $timestamps = true;

    protected $fillable = [
        'nip',
        'nama',
        'nomor_telepon',
    ];

    public function pembimbing()
    {
        return $this->hasOne(DosenPembimbing::class, 'id_dosen', 'id_dosen');
    }
}
