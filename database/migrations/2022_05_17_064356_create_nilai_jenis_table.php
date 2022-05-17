<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_jenis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_id');
            $table->integer('tugas')->nullable();
            $table->integer('pbl')->nullable();
            $table->integer('praktikum')->nullable();
            $table->integer('ujian')->nullable();
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
        Schema::dropIfExists('nilai_jenis');
    }
}
