<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodeMagang extends Model
{
    protected $table = 'periode_magang';
    protected $primaryKey = 'id_periode';
}