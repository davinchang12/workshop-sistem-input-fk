<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisFeedbackUABSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_feedback_u_a_b_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId("feedback_uab_id");
            $table->string('topik')->nullable();
            $table->integer('skor')->nullable();
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
        Schema::dropIfExists('jenis_feedback_u_a_b_s');
    }
}
