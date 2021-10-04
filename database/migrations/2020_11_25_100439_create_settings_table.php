<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('email');
            $table->string('currency')->default('$');
            $table->string('currency_code')->default('USD');
            $table->string('service_fee');
            $table->integer('per_page_data')->default(6);
            $table->string('frontsite_link')->nullable();
            $table->string('cookie_link')->nullable();
            $table->string('privacy_link')->nullable();
            $table->string('term_link')->nullable();
            $table->string('help_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('stripe_mode')->default('SANDBOX');
            $table->string('stripe_test_secret_key')->default('sk_test_key')->nullable();
            $table->string('stripe_test_pub_key')->default('pk_test_key')->nullable();
            $table->string('stripe_live_secret_key')->default('sk_live_key')->nullable();
            $table->string('stripe_live_pub_key')->default('pk_live_key')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
