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
        Schema::create('resi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('setting_id');
            $table->foreign('setting_id')
            ->references('id')
            ->on('settings')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('no_resi');
            $table->string('nama_pengirim')->nullable();
            $table->string('kota_keberangkatan');
            $table->string('nama_penerima')->nullable();
            $table->string('kota_tujuan')->nullable();
            $table->string('kapal_muatan')->nullable();
            $table->date('tgl_berangkat')->nullable();
            $table->string('tipe_muatan')->nullable();
            $table->date('tgl_serah_barang')->nullable();
            $table->integer('jml_barang')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->string('no_container')->nullable();
            $table->string('no_seal')->nullable();
            $table->string('asal_barang')->nullable();
            $table->string('tujuan_barang')->nullable();
            $table->integer('kg')->nullable();
            $table->integer('p')->nullable();
            $table->integer('l')->nullable();
            $table->integer('t')->nullable();
            $table->decimal('jumlah_kubikasi', 10, 5)->nullable();
            $table->string('trip_ke')->nullable();
            $table->string('ttd_resi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi');
    }
};
