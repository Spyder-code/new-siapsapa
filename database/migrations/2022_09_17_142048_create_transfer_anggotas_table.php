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
        Schema::create('transfer_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('tb_anggota');
            $table->foreignId('from_gudep')->nullable()->constrained('tb_gudep');
            $table->foreignId('to_gudep')->constrained('tb_gudep');
            $table->foreignId('user_created')->constrained('users');
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
        Schema::dropIfExists('transfer_anggota');
    }
};
