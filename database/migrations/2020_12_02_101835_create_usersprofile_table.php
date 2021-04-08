<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profile', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('background_image')->nullable();
            $table->string('prim_title')->nullable();
            $table->string('sec_title')->nullable();
            $table->longText('overview')->nullable();
            $table->enum('exp_level', ['1', '2', '3'])->default('1')->comment('1:Entry Level; 2:Advanced, 3:Expert');
            $table->string('start_year')->nullable();
            $table->float('hourly_rate')->nullable();
            $table->string('english_prof')->nullable();
            $table->string('city')->nullable();
            $table->string('services')->nullable();
            $table->string('skills')->nullable();
            $table->text('clients')->nullable();
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
        Schema::dropIfExists('users_profile');
    }
}
