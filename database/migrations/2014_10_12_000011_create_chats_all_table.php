<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats_all', function (Blueprint $table) {
            $table->increments('chat_id')->index();
            $table->integer('clientId');
            $table->integer('freelancerId');
            $table->integer('jobId');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['chat_id', 'clientId','freelancerId','jobId'],'chat_id_cl_fr_jobid');
            $table->index(['chat_id', 'clientId']);
            $table->index(['chat_id','freelancerId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats_all');
    }
}
