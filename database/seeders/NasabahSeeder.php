<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua jenis_klaim dari tabel
        $jenisKlaims = DB::table('jenis_klaim')->pluck('id')->toArray();

        // Daftar bulan dan tahun masuk
        $bulanMasuk = ['2024-10', '2024-11', '2024-12', '2025-01', '2025-02'];

        $nasabahData = [];

        for ($i = 1; $i <= 5; $i++) {
            $jenisKlaimId = $jenisKlaims[array_rand($jenisKlaims)];

            // Pilih bulan acak untuk tanggal masuk
            $bulanTerpilih = $bulanMasuk[array_rand($bulanMasuk)];
            $tanggalMasuk = Carbon::createFromFormat('Y-m', $bulanTerpilih)
                ->day(rand(1, 28))
                ->toDateString();

            // Tentukan tanggal dikerjakan beberapa hari setelah masuk
            $tanggalDikerjakan = (rand(0, 1) == 1)
                ? Carbon::parse($tanggalMasuk)->addDays(rand(1, 10))->toDateString()
                : null;

            $nasabahData[] = [
                'nama' => 'Nasabah ' . $i,
                'jenis_klaim_id' => $jenisKlaimId,
                'no_taspen' => 'TPN' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'tanggal_masuk' => $tanggalMasuk,
                'tanggal_dikerjakan' => $tanggalDikerjakan,
                'petugas_id' => rand(2, 4),
                'keterangan' => $tanggalDikerjakan ? 'selesai' : 'belum dikerjakan',
                'is_checked' => $tanggalDikerjakan ? true : false,
                'checked_at' => $tanggalDikerjakan ? Carbon::parse($tanggalDikerjakan)->addDays(rand(0, 5)) : null,
                'created_at' => now()->subDays(rand(1, 60)),
                'updated_at' => now()->subDays(rand(1, 60)),
            ];
        }

        DB::table('nasabah')->insert($nasabahData);
    }
}
