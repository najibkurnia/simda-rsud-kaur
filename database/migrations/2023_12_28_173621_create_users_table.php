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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nip');
            $table->string('nama');
            $table->foreignId('pangkat_id')->nullable()->constrained('pangkat', 'pangkat_id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('golongan_id')->nullable()->constrained('golongan', 'golongan_id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatan', 'jabatan_id')->nullOnDelete()->cascadeOnUpdate();
            $table->string('no_telepon');
            $table->enum('role', ['pegawai', 'admin'])->default('pegawai');
            $table->string('alamat');
            $table->string('password');
            $table->integer('total_hadir')->default(0);
            $table->integer('total_dinas')->default(0);
            $table->integer('total_cuti')->default(0);
            $table->integer('total_izin')->default(0);
            $table->integer('total_sakit')->default(0);
            $table->integer('total_telat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
