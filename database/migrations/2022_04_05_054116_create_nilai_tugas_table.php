<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_tugas', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('nilai_id');
            $table->integer('tugas_1');
            $table->integer('tugas_2');
            $table->integer('tugas_3');
            $table->integer('tugas_4');
            $table->integer('tugas_5');
            $table->integer('tugas_6');
            $table->integer('tugas_7');
            $table->integer('tugas_8'); 
            $table->integer('tugas_9');
            $table->integer('tugas_10');  
            $table->integer('tugas_11');
            $table->integer('tugas_12');
            $table->integer('tugas_13');
            $table->integer('tugas_14');
            $table->integer('tugas_15');
            $table->integer('tugas_16');
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
        Schema::dropIfExists('nilai_tugas');
    }
}
