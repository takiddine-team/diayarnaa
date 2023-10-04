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
        Schema::create('home_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('company_name_ar');
            $table->string('company_name_en');
            $table->bigInteger('diyarnaa_country_id')->constrained('diyarnaa_countries')->onDeleate('cascade');
            $table->bigInteger('diyarnaa_city_id')->constrained('diyarnaa_cities')->onDeleate('cascade');
            $table->longText('image');
            $table->longText('license_image');
            $table->string('title_ar');
            $table->string('title_en');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->string('phone');
            $table->string('email');
            $table->tinyInteger('status')->comment=' 1=>Pending,2=>Accepted,3=>Rejected, 4=>Active, 5=>Inactive';
            $table->date('expire_date')->nullable();
            $table->tinyInteger('user_type')->nullable()->comment=' 1=>Company,2=>Office';
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
        Schema::dropIfExists('home_sliders');
    }
};
