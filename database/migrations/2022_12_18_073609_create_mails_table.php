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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_id');
            $table->bigInteger('receiver_id');
            $table->tinyInteger('sender_type')->comment = '1=Admin,2=user';
            $table->tinyInteger('receiver_type')->comment = '1=Admin,2=user';
            $table->bigInteger('advertisement_id')->nullable();
            $table->longText('details');
            $table->longText('file')->nullable();
            $table->tinyInteger('email_type')->comment = '1=>Chat, 2=>Update Request, 3=>Accept, 4=>Reject, 5=>Accept with Conditions';
            $table->tinyInteger('deleter_type')->nullable()->comment = '1=>Sender,2=>Reciever, 3=>Both';
            $table->tinyInteger('is_read')->default(2)->comment = '1=>Yes, 2=>No';
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
        Schema::dropIfExists('mails');
    }
};
