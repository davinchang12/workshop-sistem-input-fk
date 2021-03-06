<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSOCASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_s_o_c_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_lain_id');
            $table->string('namasoca');
            $table->string('nama_penguji');
            $table->string('keterangan');
            $table->float('nilaisocas', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_s_o_c_a_s');
    }
}
