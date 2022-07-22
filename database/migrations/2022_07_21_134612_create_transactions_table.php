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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('transaction_detail_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kta_id')->constrained('kta')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('anggota_id')->constrained('tb_anggota')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('harga');
            $table->foreignId('golongan')->constrained('pramuka')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('status_percetakan')->default(0);
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
        Schema::dropIfExists('transactions');
    }
};
