<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenPembimbing extends Model
{
    use HasFactory;

    protected $table = 'dosen_pembimbing';
    protected $primaryKey = 'id_dosen_pembimbing';
    public $timestamps = true;
    protected $fillable = ['id_dosen', 'jumlah_bimbingan'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
}