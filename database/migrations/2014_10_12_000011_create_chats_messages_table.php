<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('chats_messages', function (Blueprint $table)
        { 
            $table->id();
            $table->integer('chatId')->index();
            $table->longText('message');
            $table->longText('attach_url');
            $table->integer('sendByClient');
            $table->integer('sendByFreelancer');
            $table->integer('clientId');
            $table->integer('msg_status_client');
            $table->integer('msg_status_freelancer');
            $table->integer('freelancerId');
            $table->timestamp('DateTime')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['chatId', 'msg_status_client','msg_status_freelancer'],"chatid_msgcl_msgfr");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats_messages');
    }
}
