<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSavedSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_saved_searches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('search_name')->nullable();
            $table->json('search_filters')->nullable();
            $table->enum('alert_on', ['1', '2'])->default('2')->comment('1:Alert_On; 2:Alert_Off');
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
        Schema::dropIfExists('users_saved_searches');
    }
}
