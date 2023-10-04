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
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->bigInteger('main_category_id')->constrained('main_categories')->onDelete('cascade');
            $table->bigInteger('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->integer('construction_age')->nullable()->constrained('features')->onDelete('cascade');
            $table->integer('land_area')->nullable()->constrained('features')->onDelete('cascade');
            $table->integer('real_estate_status')->nullable()->constrained('features')->onDelete('cascade');
            $table->integer('number_of_rooms')->nullable()->constrained('features')->onDelete('cascade');
            $table->integer('number_of_bathrooms')->nullable()->constrained('features')->onDelete('cascade');
            $table->bigInteger('diyarnaa_country_id')->constrained('diyarnaa_countries')->onDelete('cascade');
            $table->bigInteger('diyarnaa_city_id')->constrained('diyarnaa_cities')->onDelete('cascade');
            $table->bigInteger('diyarnaa_region_id')->constrained('diyarnaa_regions')->onDelete('cascade');
            $table->decimal('price_from', 10, 2);
            $table->decimal('price_to', 10, 2);
            $table->decimal('area_from', 10, 2);
            $table->decimal('area_to', 10, 2);
            $table->bigInteger('area_type_id')->constrained('features')->onDelete('cascade');
            $table->tinyInteger('status')->comment = '1=>Active, 2=>Inactive';
            $table->string('code')->nullable();
            $table->integer('edit_balance')->default(1);
            $table->date('expiry_date');
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
        Schema::dropIfExists('searches');
    }
};
