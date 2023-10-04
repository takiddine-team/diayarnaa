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
        Schema::create('customer_request_and_offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->bigInteger('target_id')->constrained('targets')->onDelete('cascade');
            $table->bigInteger('category_id')->constrained('main_categories')->onDelete('cascade');
            $table->bigInteger('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->bigInteger('diyarnaa_country_id')->constrained('diyarnaa_countries')->onDelete('cascade');
            $table->bigInteger('diyarnaa_city_id')->constrained('diyarnaa_cities')->onDelete('cascade');
            $table->bigInteger('diyarnaa_region_id')->constrained('diyarnaa_regions')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->decimal('area', 10, 2);
            $table->longText('address');
            $table->longText('video')->nullable();
            $table->longText('advertising');
            $table->tinyInteger('type')->comment = '1=>Request,2=>Offer';
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
        Schema::dropIfExists('customer_request_and_offers');
    }
};
