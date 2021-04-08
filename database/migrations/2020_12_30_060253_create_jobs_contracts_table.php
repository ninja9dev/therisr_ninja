<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_by')->unsigned();
            $table->integer('user_to')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->integer('proposal_id')->unsigned()->nullable();;
            $table->enum('contract_status', ['1', '2', '3', '4', '5', '6'])->default('1')->comment('1:Draft; 2:Active; 3:Archived; 4:Reject; 5:Paused; 6:Completed');
            $table->enum('contract_type', ['1', '2'])->default('1')->comment('1:Hourly; 2:Fixed');
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
            $table->timestamp('offer_sent_on')->nullable();
            $table->timestamp('contract_paused_on')->nullable();
            $table->timestamp('contract_end_on')->nullable();
            $table->timestamp('contract_start_on')->nullable();
            $table->timestamp('rejected_at')->nullable();
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
        Schema::dropIfExists('jobs_contracts');
    }
}
