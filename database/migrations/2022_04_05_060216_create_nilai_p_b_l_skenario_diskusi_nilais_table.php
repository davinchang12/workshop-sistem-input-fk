<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPBLSkenarioDiskusiNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_p_b_l_skenario_diskusi_nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilaipblskenariodiskusi_id');
            $table->integer('kehadiran');
            $table->integer('aktivitas_diskusi_relevansi_pembicaraan');
            $table->integer('keterampilan_berkomunikasi');
            $table->integer('laporan_sementara')->nullable();
            $table->integer('laporan_resmi')->nullable();
            $table->text('catatan_kesan_kegiatan_diskusi_tutorial')->nullable();
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
        Schema::dropIfExists('nilai_p_b_l_skenario_diskusi_nilais');
    }
}
