<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSemesterFieldLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_semester_field_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_field_lab_id');
            $table->float('total_nilai_dosbing', 8, 2);
            $table->float('total_nilai_penguji', 8, 2);
            $table->float('total_nilai_penguji_2', 8, 2)->nullable();
            $table->float('nilai_akhir');
            $table->string('keterangan_akhir');
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
        Schema::dropIfExists('nilai_semester_field_labs');
    }
}
