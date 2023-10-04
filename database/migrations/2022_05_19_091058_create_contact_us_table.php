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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('phone_two')->nullable();
            $table->longText('email');
            $table->longText('url_map');
            $table->longText('facebook');
            $table->longText('twitter');
            $table->longText('instagram');
            $table->longText('linkedin');
            $table->longText('messanger');
            $table->longText('youtube');
            $table->longText('background_image');

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
        Schema::dropIfExists('contact_us');
    }
};
