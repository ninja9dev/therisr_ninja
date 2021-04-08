<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('uniq_job_id')->nullable();
            $table->enum('job_status', ['1', '2', '3', '4'])->default('1')->comment('1:Draft; 2:Active; 3:Archived; 4:Paused');
            $table->enum('job_type', ['1', '2'])->default('1')->comment('1:Hourly; 2:Fixed');
            $table->float('hourly_rate')->nullable();
            $table->integer('weekly_limit')->nullable();
            $table->integer('project_length')->nullable();
            $table->float('total_cost')->nullable();
            $table->date('due_date')->nullable();
            $table->string('job_title')->nullable();
            $table->longText('job_description')->nullable();
            $table->string('expertise')->nullable();
            $table->text('skills')->nullable();
            $table->enum('exp_level', ['1', '2', '3'])->default('1')->comment('1:Entry Level; 2:Advanced, 3:Expert');
            $table->string('english_prof')->nullable();
            $table->string('therisr_score')->nullable();
            $table->json('interview_questions')->nullable();
            $table->timestamp('posted_at')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
