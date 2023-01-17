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
        Schema::create('agenda_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')->constrained('agenda')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('anggota_id')->constrained('tb_anggota')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gudep_id')->constrained('tb_gudep')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('agenda_files');
    }
};
