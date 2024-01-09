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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perusahaan', 10);
            $table->string('nama_perusahaan');
            $table->string('lini_bisnis');
            $table->string('email');
            $table->string('phone', 21);
            $table->string('fax');
            $table->text('alamat');
            $table->string('npwp');
            $table->string('ttd_resi');
            $table->string('ttd_kwitansi');
            $table->string('ttd_nama_resi');
            $table->string('ttd_nama_kwitansi');
            $table->string('no_rek_1');
            $table->string('no_rek_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
