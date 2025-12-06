<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKlaimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_klaim' => 'Pensiun',
                'keterangan' => 'Klaim manfaat Pensiun Pegawai'
            ],
            [
                'nama_klaim' => 'JHT',
                'keterangan' => 'Jaminan Hari Tua (JHT)'
            ],
            [
                'nama_klaim' => 'JKK',
                'keterangan' => 'Jaminan Kecelakaan Kerja'
            ],
            [
                'nama_klaim' => 'JKM',
                'keterangan' => 'Jaminan Kematian'
            ],
            [
                'nama_klaim' => 'Tabungan Hari Tua',
                'keterangan' => 'Manfaat Tabungan Hari Tua'
            ],
        ];
        DB::table('jenis_klaim')->insert($data);
    }
}
