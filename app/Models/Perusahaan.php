<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaan extends Model
{
    protected $table = 'perusahaan_mitra';
    protected $primaryKey = 'id_perusahaan_mitra';
}