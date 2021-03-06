<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dob');
            $table->string('fathername');
            $table->string('nrc');
            $table->string('phone');
            $table->longText('photo');
            $table->date('joineddate');
            $table->date('leavedate')->nullable();
            $table->boolean('status')->default(false);

            //location
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');

            //user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            
            $table->softDeletes();
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
        Schema::dropIfExists('staff');
    }
}
