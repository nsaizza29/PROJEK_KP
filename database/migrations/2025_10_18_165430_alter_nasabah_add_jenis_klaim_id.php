<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('nasabah', function (Blueprint $table) {
            // tambahkan kolom jenis_klaim_id
            $table->foreignId('jenis_klaim_id')
                  ->nullable()
                  ->constrained('jenis_klaim')
                  ->nullOnDelete();

            // hapus kolom lama (opsional, bisa disimpan sementara)
            $table->dropColumn('jenis_klaim');
        });
    }

    public function down(): void
    {
        Schema::table('nasabah', function (Blueprint $table) {
            $table->string('jenis_klaim')->nullable();
            $table->dropConstrainedForeignId('jenis_klaim_id');
        });
    }
};
