<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('consignment_id');
            $table->string('recipient_name');
            $table->string('recipient_mobile');
            $table->text('recipient_address');
            $table->string('status');
            $table->string('delivery_on')->nullable();
            $table->string('returned_on')->nullable();
            $table->string('amount');
            $table->string('charge');
            $table->string('store')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
