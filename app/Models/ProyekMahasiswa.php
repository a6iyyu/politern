<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'proyek_mahasiswa';
    protected $fillable = ['id_mahasiswa', 'id_proyek'];
    public $timestamps = false;
}