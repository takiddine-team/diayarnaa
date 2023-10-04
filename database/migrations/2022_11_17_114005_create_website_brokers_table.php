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
        Schema::create('website_brokers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->longText('image')->nullable();
            $table->longText('file')->nullable();
            $table->bigInteger('diyarnaa_country_id')->constrained('diyarnaa_countries')->onDelete('cascade');
            $table->bigInteger('diyarnaa_city_id')->constrained('diyarnaa_cities')->onDelete('cascade');
            $table->tinyInteger('status')->comment=' 1=>Pending,2=>Accept,3=>Reject, 4=>Active, 5=>Inactive';
            $table->longText('details')->nullable();
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
        Schema::dropIfExists('website_brokers');
    }
};
