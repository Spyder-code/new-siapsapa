<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanitiaAgendaTable extends Migration
{
    public function up()
    {
        Schema::create('panitia_agenda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')->constrained('agenda');
            $table->foreignId('anggota_id')->constrained('tb_anggota');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('panitia_agenda');
    }
}
