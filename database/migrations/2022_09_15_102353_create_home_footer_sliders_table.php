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
        Schema::create('home_footer_sliders', function (Blueprint $table) {
            $table->id();
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->tinyInteger('status')->comment = '1=active || 2=inactive';
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
        Schema::dropIfExists('home_footer_sliders');
    }
};
