<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilNilaiUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_nilai_ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId("nilai_ujian_id");
            $table->float('utb', 8, 2)->nullable();
            $table->float('uab', 8, 2)->nullable();
            $table->float('ratarataujian', 8, 2)->nullable();
            $table->float('remediujian', 8, 2)->nullable();
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
        Schema::dropIfExists('hasil_nilai_ujians');
    }
}
