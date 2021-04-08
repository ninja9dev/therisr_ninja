<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsContractsEndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('jobs_contracts_end', function (Blueprint $table) {
            $table->id();
            $table->integer('user_by')->unsigned();
            $table->integer('user_to')->unsigned();
            $table->integer('contract_id')->unsigned();
            $table->json('all_ratings')->nullable();
            $table->float('user_score')->nullable();
            $table->longText('comment_for_user')->nullable();
            $table->float('therisr_score')->nullable();
            $table->longText('comment_for_therisr')->nullable();
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
        Schema::dropIfExists('jobs_contracts_end');
    }
}
