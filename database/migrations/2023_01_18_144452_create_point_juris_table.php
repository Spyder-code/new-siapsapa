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
        Schema::create('point_juri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lomba_file_id')->nullable()->constrained('lomba_files')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gudep_id')->nullable()->constrained('tb_gudep')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('peserta_id')->nullable()->constrained('peserta_lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('juri_id')->nullable()->constrained('juri')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('point');
            $table->string('description')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('point_juri');
    }
};
