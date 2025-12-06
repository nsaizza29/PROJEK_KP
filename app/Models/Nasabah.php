<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';

    protected $fillable = [
        'nama',
        'jenis_klaim_id',
        'no_taspen',
        'tanggal_masuk',
        'tanggal_dikerjakan',
        'petugas_id',
        'keterangan',
        'is_checked',
        'checked_at',
    ];

    protected $casts = [
        'is_checked' => 'boolean',
        'checked_at' => 'datetime',
        'tanggal_masuk' => 'date',
        'tanggal_dikerjakan' => 'date',
    ];

    /**
     * Relasi ke petugas (user yang menangani nasabah)
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Relasi ke jenis klaim
     */
    public function jenisKlaim()
    {
        return $this->belongsTo(JenisKlaim::class, 'jenis_klaim_id');
    }
}
