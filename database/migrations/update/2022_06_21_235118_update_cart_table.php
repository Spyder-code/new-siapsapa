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
        Schema::table('carts', function (Blueprint $table) {
            // $table->foreignId('kta_id')->after('user_id')->nullable()->constrained('kta');
            $table->removeColumn('kta_id');
            $table->foreignId('anggota_id')->after('user_id')->constrained('tb_anggota');
            $table->foreignId('golongan')->after('anggota_id')->constrained('pramuka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
