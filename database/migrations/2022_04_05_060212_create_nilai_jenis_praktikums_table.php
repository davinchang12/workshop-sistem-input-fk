<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiJenisPraktikumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_jenis_praktikums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_praktikum_id');
            $table->integer('rata_rata_quiz');
            $table->integer('rata_rata_laporan');
            $table->integer('nilai_responsi');
            $table->integer('nilai_akhir');
            $table->string('keterangan_nilai_akhir')->nullable();
            $table->string('keterangan_nilai_akhir_berdasarkan')->nullable();
            $table->integer('remedi')->nullable();
            $table->integer('remedi_konversi')->nullable();
            $table->integer('nilai_setelah_remedi')->nullable();
            $table->string('keterangan_nilai_setelah_remedi')->nullable();
            $table->string('keterangan_nilai_setelah_remedi_berdasarkan')->nullable();
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
        Schema::dropIfExists('nilai_jenis_praktikums');
    }
}
