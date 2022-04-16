<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiOSCESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_o_s_c_e_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_id');
            $table->string('namaosce');
            $table->string('nama_penguji');
            $table->integer('nilaiosce')->nullable();
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
        Schema::dropIfExists('nilai_o_s_c_e_s');
    }
}
