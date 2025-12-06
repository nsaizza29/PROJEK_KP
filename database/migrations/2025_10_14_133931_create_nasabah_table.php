<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('jenis_klaim_id')->nullable()->constrained('jenis_klaim')->nullOnDelete();
            $table->string('no_taspen')->unique();
            $table->date('tanggal_masuk'); // format: YYYY-MM
            $table->date('tanggal_dikerjakan')->nullable();
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('keterangan')->nullable(); // sudah dikerjakan atau belum
            $table->boolean('is_checked')->default(false);
            $table->timestamp('checked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah');
    }
};
