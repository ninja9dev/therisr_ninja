<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->enum('job_type', ['1', '2'])->default('1')->comment('1:Hourly; 2:Fixed');
            $table->enum('like_status', ['1', '2'])->default('1')->comment('1:UnLike; 2:Liked');
            $table->enum('proposal_status', ['1', '2'])->default('1')->comment('1:Unarchived; 2:Archived');
            $table->longText('introduce')->nullable();
            $table->json('interview_questions')->nullable();
            $table->float('hourly_rate')->nullable();
            $table->float('total_cost')->nullable();
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
        Schema::dropIfExists('jobs_proposals');
    }
}
