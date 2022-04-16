<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisSOCASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_s_o_c_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilaijenissoca_id');
            $table->string('keterangan_soca');
            $table->integer('skor_soca');
            $table->integer('bobot')->nullable();
            $table->string('kepuasan_presentasi');
            $table->text('komentar')->nullable();
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
        Schema::dropIfExists('jenis_s_o_c_a_s');
    }
}
