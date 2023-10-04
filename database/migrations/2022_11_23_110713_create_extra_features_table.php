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
        Schema::create('extra_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('advertisement_id')->constrained('advertisements')->onDelete('cascade');
            $table->string('title_ar');
            $table->string('title_en');

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
        Schema::dropIfExists('extra_features');
    }
};
