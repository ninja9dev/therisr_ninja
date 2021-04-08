<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsContractsTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_contracts_timesheet', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:Pending; 2:Approved');
            $table->string('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('time')->nullable(); 
            $table->float('amount')->nullable();
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
        Schema::dropIfExists('jobs_contracts_timesheet');
    }
}
