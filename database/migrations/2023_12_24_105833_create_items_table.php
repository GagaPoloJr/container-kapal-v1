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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('container_id');
            $table->foreign('container_id')
            ->references('id')
            ->on('containers')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('jml_barang')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->decimal('kg', 10, 2)->nullable(); // 10 total digits with 2 decimal places
            $table->decimal('p', 10, 2)->nullable();
            $table->decimal('l', 10, 2)->nullable();
            $table->decimal('t', 10, 2)->nullable();
            $table->decimal('jumlah_kubikasi', 20, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
