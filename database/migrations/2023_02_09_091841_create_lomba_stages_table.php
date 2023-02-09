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
        Schema::create('lomba_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gudep_id')->constrained('tb_gudep')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('peserta_id')->constrained('peserta_lomba')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('stage')->default(1);
            $table->integer('point')->default(0);
            $table->boolean('is_elimination')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('lomba_stages');
    }
};
