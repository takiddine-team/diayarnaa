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
        Schema::create('premium_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->decimal('price', 10, 2);
            $table->integer('number_days_ad');
            $table->integer('number_days_membership');
            $table->integer('number_of_ads')->nullable();
            $table->tinyInteger('user_type')->comment = '1=>Real Estate Office ,2=>Real Estate Owner, 3=>Real Estate Seeker';
            $table->tinyInteger('featured_type')->comment = '1=>True, 2=>False';
            $table->tinyInteger('unlimited_status')->comment = '1=>True, 2=>False';
            $table->tinyInteger('status')->comment = '1 => Active || 2 => Inactive';
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
        Schema::dropIfExists('premium_memberships');
    }
};
