<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancerLkSkipJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancer_lk_skip_jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->enum('like_status', ['1', '2'])->default('1')->comment('1:UnLike; 2:Liked');
            $table->enum('skip_status', ['1', '2'])->default('1')->comment('1:Un skipped; 2:Skipped');
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
        Schema::dropIfExists('freelancer_lk_skip_jobs');
    }
}
