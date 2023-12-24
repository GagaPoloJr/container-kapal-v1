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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resi_id');
            $table->foreign('resi_id')
            ->references('id')
            ->on('resi')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('no_container');
            $table->string('no_seal');
            $table->string('asal_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
