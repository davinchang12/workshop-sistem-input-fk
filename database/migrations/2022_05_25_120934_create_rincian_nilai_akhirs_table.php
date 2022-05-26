<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianNilaiAkhirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_nilai_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_id');
            $table->decimal('tugas', 8, 2);
            $table->decimal('utb', 8, 2);
            $table->decimal('uab', 8, 2);
            $table->decimal('nilai_akhir', 8, 2);
            $table->string('keterangan');
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
        Schema::dropIfExists('rincian_nilai_akhirs');
    }
}
