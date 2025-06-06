<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeMagang extends Model
{
    protected $table = 'periode_magang';
    protected $primaryKey = 'id_periode';
    public $timestamps = true;

    protected $fillable = ['nama_periode', 'tanggal_mulai', 'tanggal_selesai', 'semester'];
}