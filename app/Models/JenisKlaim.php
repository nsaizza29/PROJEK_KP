<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKlaim extends Model
{
    use HasFactory;

    protected $table = 'jenis_klaim';
    protected $fillable = ['nama_klaim', 'keterangan'];

    public function nasabah()
    {
        return $this->hasMany(Nasabah::class, 'jenis_klaim_id');
    }
    public function jenisKlaim()
    {
    return $this->belongsTo(JenisKlaim::class, 'jenis_klaim_id');
    }

}
