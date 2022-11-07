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
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->integer('province_id')->after('phone')->nullable();
            $table->integer('city_id')->after('province_id')->nullable();
            $table->integer('district_id')->after('city_id')->nullable();
            $table->string('ekspedisi_name')->after('district_id')->nullable();
            $table->string('ekspedisi_tipe')->after('ekspedisi_name')->nullable();
            $table->string('ekspedisi_price')->after('ekspedisi_tipe')->nullable();
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
