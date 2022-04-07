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
            $table->integer('tugas_1')->nullable();
            $table->integer('tugas_2')->nullable();
            $table->integer('tugas_3')->nullable();
            $table->integer('tugas_4')->nullable();
            $table->integer('tugas_5')->nullable();
            $table->integer('tugas_6')->nullable();
            $table->integer('tugas_7')->nullable();
            $table->integer('tugas_8')->nullable(); 
            $table->integer('tugas_9')->nullable();
            $table->integer('tugas_10')->nullable();  
            $table->integer('tugas_11')->nullable();
            $table->integer('tugas_12')->nullable();
            $table->integer('tugas_13')->nullable();
            $table->integer('tugas_14')->nullable();
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
