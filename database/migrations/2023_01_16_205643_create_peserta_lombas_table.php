<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('nodaf');
            $table->foreignId('lomba_id')->constrained('lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('anggota_id')->constrained('tb_anggota')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gudep_id')->constrained('tb_gudep')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_kelompok')->nullable();
            $table->integer('order');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_lombas');
    }
};
