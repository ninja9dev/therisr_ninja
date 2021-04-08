<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsContractsEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_contracts_earnings', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_id')->unsigned();
            $table->enum('contract_type', ['1', '2'])->default('1')->comment('1:Hourly; 2:Fixed');
            $table->integer('job_id')->unsigned();
            $table->string('earning_for')->nullable();
            $table->string('charge_id')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1:Pending; 2:Paid');
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
        Schema::dropIfExists('jobs_contracts_earnings');
    }
}
