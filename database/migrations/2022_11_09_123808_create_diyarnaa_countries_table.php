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
        Schema::create('diyarnaa_countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_key');
            $table->string('country_code');
            $table->bigInteger('public_country_id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->longText('flag');
            $table->longText('image');
            $table->bigInteger('public_currency_id')->constrained('public_currencies')->onDeleate('cascade');
            $table->tinyInteger('status')->comment='1 => Active || 2 =>Inactive';
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
        Schema::dropIfExists('diyarnaa_countries');
    }
};
