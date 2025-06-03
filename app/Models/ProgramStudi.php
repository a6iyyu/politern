<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';
    protected $fillable = [
        'kode',
        'nama',
        'jenjang',
        'jurusan',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_prodi', 'id_prodi');
    }
}