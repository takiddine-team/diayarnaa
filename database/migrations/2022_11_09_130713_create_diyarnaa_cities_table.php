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
        Schema::create('diyarnaa_cities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diyarnaa_country_id')->constrained('diyarnaa_countries')->onDeleate('cascade');
            $table->string('name_en');
            $table->string('name_ar');
            $table->tinyInteger('status')->default(1)->comment = "1=> Active || 2=> Inactive";
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
        Schema::dropIfExists('diyarnaa_cities');
    }
};
