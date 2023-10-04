<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('background_images', function (Blueprint $table) {
            $table->id();
            $table->longText('website_broker')->nullable();
            $table->longText('complaint')->nullable();
            $table->longText('job')->nullable();
            $table->longText('term_condition')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('user_signup')->nullable();
            $table->longText('user_login')->nullable();
            $table->longText('advertisement_details')->nullable();
            $table->longText('user_dashboard')->nullable();
            $table->longText('customer_opinion')->nullable();
            

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
        Schema::dropIfExists('background_images');
    }
};
