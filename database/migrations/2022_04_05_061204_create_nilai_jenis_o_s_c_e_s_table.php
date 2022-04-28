<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiJenisOSCESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_jenis_o_s_c_e_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilaiosce_id');
            $table->integer('bobot')->nullable();
            $table->string('aspekdinilaiosce');

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
        Schema::dropIfExists('nilai_jenis_o_s_c_e_s');
    }
}
