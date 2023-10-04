<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('public_countries')->onDelete('cascade');
            $table->longText('country_key');
            $table->longText('name_ar');
            $table->longText('name_en');
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
        Schema::dropIfExists('public_regions');
    }
}
