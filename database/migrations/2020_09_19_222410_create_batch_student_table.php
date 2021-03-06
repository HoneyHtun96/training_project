<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')
                  ->references('id')->on('batches')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('batch_student');
    }
}
