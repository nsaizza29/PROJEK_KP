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
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('petugas'); // admin, petugas
            }

            if (!Schema::hasColumn('users', 'nip')) {
                $table->string('nip')->unique()->nullable();
            }

            if (!Schema::hasColumn('users', 'alamat')) {
                $table->string('alamat')->nullable();
            }

            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'nip')) {
                $table->dropColumn('nip');
            }
            if (Schema::hasColumn('users', 'alamat')) {
                $table->dropColumn('alamat');
            }
            if (Schema::hasColumn('users', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
        });
    }
};
