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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('target_id')->constrained('targets')->onDelete('cascade');
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
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('street')->nullable();
            $table->longText('url_map');
            $table->longText('address')->nullable();
            $table->integer('price');
            $table->integer('area');
            $table->bigInteger('area_type_id')->constrained('features')->onDelete('cascade');
            $table->longText('real_estate_formula');
            $table->longText('main_image');
            $table->longText('video')->nullable();
            $table->string('ad_reference')->nullable();
            $table->tinyInteger('status')->comment = '1=>Pending, 2=>Accept, 3=>Reject, 4=>Active, 5=>Inactive, 6=>Accept with Conditions';
            $table->tinyInteger('contact_method')->nullable()->comment = '1=>Mobile, 2=>Whatsapp, 3=>Email';
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('code')->nullable();
            $table->string('real_estate_agent_name')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
};
