<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_education', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('major')->nullable();
            $table->string('school_name')->nullable();
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
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
        Schema::dropIfExists('users_education');
    }
}
