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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();//type 2/3
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->string('office_phone')->nullable();//type 1
            $table->string('diyarnaa_country_id')->constrained('diyarnaa_countries')->onDelete('cascade');
            $table->string('diyarnaa_city_id')->constrained('diyarnaa_cities')->onDelete('cascade');
            $table->string('diyarnaa_region_id')->nullable()->constrained('diyarnaa_regions')->onDelete('cascade');
            $table->longText('street')->nullable();//type 2/3
            $table->string('password');
            $table->tinyInteger('user_type')->comment= '1=>Real Estate Office ,2=>Real Estate Owner, 3=>Real Estate Seeker';
            $table->tinyInteger('status')->comment= '1=>Pending, 2=>Accept, 3=>Reject 4=>Active, 5=>Inactive';
            $table->longText('license_image')->nullable();//type 1
            $table->longText('profile_image')->nullable();//type 1
            $table->longText('additional_information')->nullable();
            $table->date('expire_date')->nullable();//type 1
            $table->string('code')->nullable();
            $table->tinyInteger('is_verified')->default(1)->nullable()->comment('1 => Not Verified || 2 => Verified');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
