<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BidangMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'bidang_mahasiswa';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_mahasiswa', 'id_bidang'];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }
}