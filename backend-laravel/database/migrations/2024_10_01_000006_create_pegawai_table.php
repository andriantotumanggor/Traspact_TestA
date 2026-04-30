<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->enum('jk', ['L', 'P']);
            $table->string('agama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('golongan_id')->constrained('golongan')->onDelete('restrict');
            $table->foreignId('eselon_id')->nullable()->constrained('eselon')->onDelete('set null');
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('restrict');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerja')->onDelete('restrict');
            $table->foreignId('tempat_tugas_id')->constrained('tempat_tugas')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
