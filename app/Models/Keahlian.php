<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keahlian extends Model
{
    use HasFactory;

    protected $table = 'keahlian';
    protected $primaryKey = 'id_keahlian';
    protected $fillable = ['nama_keahlian'];
    public $timestamps = false;

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'keahlian_mahasiswa', 'id_keahlian', 'id_mahasiswa');
    }
}