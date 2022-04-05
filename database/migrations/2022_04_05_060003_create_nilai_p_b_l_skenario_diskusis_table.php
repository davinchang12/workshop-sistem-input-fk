<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPBLSkenarioDiskusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_p_b_l_skenario_diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilaipblskenario_id');
            $table->string('diskusi');
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
        Schema::dropIfExists('nilai_p_b_l_skenario_diskusis');
    }
}
