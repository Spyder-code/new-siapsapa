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
        Schema::create('lomba_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('peserta_id')->nullable()->constrained('peserta_lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('anggota_id')->constrained('tb_anggota')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gudep_id')->nullable()->constrained('tb_gudep')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('mime')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('lomba_files');
    }
};
