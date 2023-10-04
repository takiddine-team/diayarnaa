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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->longText('slider_url');
            $table->longText('slider_button_url');
            $table->longText('slider_button_text_en');
            $table->bigInteger('country_id')->constrained('public_countries')->onDelete('cascade');
            $table->bigInteger('user_id')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('status')->comment = '1 => Active || 2 => Inactive';
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
        Schema::dropIfExists('sliders');
    }
};
