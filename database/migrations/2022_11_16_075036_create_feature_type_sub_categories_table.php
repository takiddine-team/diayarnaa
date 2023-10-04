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
        Schema::create('feature_type_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feature_type_id')->constrained('feature_types')->onDelete('cascade');
            $table->bigInteger('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
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
        Schema::dropIfExists('feature_type_sub_categories');
    }
};
