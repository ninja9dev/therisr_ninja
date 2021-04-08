<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEmployeeProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_empprofile', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('background_image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->string('phone_Code')->nullable();
            $table->string('phone')->nullable();
            $table->string('timezone')->nullable();
            $table->string('city')->nullable();
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
        Schema::dropIfExists('users_empprofile');
    }
}
