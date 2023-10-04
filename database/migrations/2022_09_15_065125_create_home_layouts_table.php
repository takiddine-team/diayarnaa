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
        Schema::create('home_layouts', function (Blueprint $table) {
            $table->id();
            $table->string('slider_title_ar');
            $table->string('slider_title_en');
            $table->longText('slider_description_ar');
            $table->longText('slider_description_en');
            $table->longText('slider_url');
            $table->longText('slider_image');

            $table->string('service_one_title_ar');
            $table->string('service_one_title_en');
            $table->longText('service_one_description_en');
            $table->longText('service_one_description_ar');
            $table->longText('service_one_url');
            $table->longText('service_one_image');

            $table->string('service_two_title_en');
            $table->string('service_two_title_ar');
            $table->longText('service_two_description_en');
            $table->longText('service_two_description_ar');
            $table->longText('service_two_url');
            $table->longText('service_two_image');

            $table->string('service_three_title_en');
            $table->string('service_three_title_ar');
            $table->longText('service_three_description_en');
            $table->longText('service_three_description_ar');
            $table->longText('service_three_url');
            $table->longText('service_three_image');

            $table->string('service_four_title_en');
            $table->string('service_four_title_ar');
            $table->longText('service_four_description_en');
            $table->longText('service_four_description_ar');
            $table->longText('service_four_url');
            $table->longText('service_four_image');

            $table->string('home_about_title_en');
            $table->string('home_about_title_ar');
            $table->longText('home_about_description_en');
            $table->longText('home_about_description_ar');
            $table->longText('home_about_image');
            $table->longText('home_about_url');
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
        Schema::dropIfExists('home_layouts');
    }
};
