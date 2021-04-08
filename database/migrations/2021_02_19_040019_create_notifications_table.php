<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_to')->unsigned();
            $table->enum('read_status', ['0', '1'])->default('0')->comment('0:Unread; 1:Read');
            $table->longText('notification')->nullable();
            $table->json('notification_data')->nullable();
            $table->string('action')->nullable();
            $table->integer('mainTableId')->unsigned()->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
