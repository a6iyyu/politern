<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BobotKriteria extends Model
{
    use HasFactory;
    protected $table = 'bobot_kriteria';

    protected $fillable = [
        'id_mahasiswa',
        'prioritas_keahlian',
        'prioritas_lokasi',
        'prioritas_jenis_lokasi',
        'prioritas_bidang',
        'prioritas_durasi',
        'prioritas_gaji'
    ];

    protected $casts = [
        'prioritas_keahlian' => 'integer',
        'prioritas_lokasi' => 'integer',
        'prioritas_jenis_lokasi' => 'integer',
        'prioritas_bidang' => 'integer',
        'prioritas_durasi' => 'integer',
        'prioritas_gaji' => 'integer'
    ];

    /**
     * Relasi ke model Mahasiswa
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    /**
     * Validasi bahwa setiap prioritas unik (tidak boleh ada duplikasi)
     */
    public function validateUniquePriorities(): bool
    {
        $priorities = array_filter([
            $this->prioritas_keahlian,
            $this->prioritas_lokasi,
            $this->prioritas_jenis_lokasi,
            $this->prioritas_bidang,
            $this->prioritas_durasi,
            $this->prioritas_gaji
        ]);

        return count($priorities) === count(array_unique($priorities));
    }

    /**
     * Cek apakah ada prioritas yang diset
     */
    public function hasAnyPriority(): bool
    {
        return $this->prioritas_keahlian !== null ||
            $this->prioritas_lokasi !== null ||
            $this->prioritas_jenis_lokasi !== null ||
            $this->prioritas_bidang !== null ||
            $this->prioritas_durasi !== null ||
            $this->prioritas_gaji !== null;
    }

    /**
     * Get array bobot berdasarkan prioritas
     */
    public function getWeightsArray(): array
    {
        $priorityWeights = [
            1 => 0.2742, // Prioritas tertinggi
            2 => 0.2174,
            3 => 0.1736,
            4 => 0.1382,
            5 => 0.1103,
            6 => 0.0879  // Prioritas terendah
        ];

        if (!$this->hasAnyPriority()) {
            // Jika tidak ada prioritas, semua sama
            return [
                'C1' => 1 / 6, // Keahlian
                'C2' => 1 / 6, // Lokasi
                'C3' => 1 / 6, // Jenis Lokasi
                'C4' => 1 / 6, // Bidang
                'C5' => 1 / 6, // Durasi
                'C6' => 1 / 6, // Gaji
            ];
        }

        return [
            'C1' => $this->prioritas_keahlian ? $priorityWeights[$this->prioritas_keahlian] : 0,
            'C2' => $this->prioritas_lokasi ? $priorityWeights[$this->prioritas_lokasi] : 0,
            'C3' => $this->prioritas_jenis_lokasi ? $priorityWeights[$this->prioritas_jenis_lokasi] : 0,
            'C4' => $this->prioritas_bidang ? $priorityWeights[$this->prioritas_bidang] : 0,
            'C5' => $this->prioritas_durasi ? $priorityWeights[$this->prioritas_durasi] : 0,
            'C6' => $this->prioritas_gaji ? $priorityWeights[$this->prioritas_gaji] : 0,
        ];
    }
}
