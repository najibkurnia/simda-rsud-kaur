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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id('riwayat_id');
            $table->string('tanggal_riwayat');
            $table->foreignId('presensi_id')->nullable()->constrained('presensi', 'presensi_id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('permintaan_id')->nullable()->constrained('permintaan', 'permintaan_id')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
