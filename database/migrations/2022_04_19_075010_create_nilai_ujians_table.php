<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_id');
            $table->float('sintakutb', 8, 2)->nullable();
            $table->float('sintakuab', 8, 2)->nullable();
            $table->float('finalcbt', 8, 2)->nullable();
            $table->float('uabcombined', 8, 2)->nullable();
            $table->float('uabcombinedremedial', 8, 2)->nullable();
            $table->float('ratamin', 8, 2)->nullable();
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
        Schema::dropIfExists('nilai_ujians');
    }
}
