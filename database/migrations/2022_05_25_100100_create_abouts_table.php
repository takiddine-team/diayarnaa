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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->longText('about_description_en');
            $table->longText('about_description_ar');
            $table->longText('about_image');

            $table->longText('our_message_en');
            $table->longText('our_message_ar');
            $table->longText('our_message_image');

            $table->longText('our_vission_en');
            $table->longText('our_vission_ar');
            $table->longText('our_vission_image');

            $table->longText('our_value_en');
            $table->longText('our_value_ar');
            $table->longText('our_value_image');

            $table->longText('background_aboutus_image');
            $table->longText('background_company_image');

           
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
        Schema::dropIfExists('abouts');
    }
};
