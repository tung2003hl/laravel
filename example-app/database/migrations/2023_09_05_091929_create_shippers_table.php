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
        Schema::create('shippers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                  ->references("id")
                  ->on('orders')
                  ->onDelete("cascade");
            $table->unsignedBigInteger('shipper_id');
            $table->foreign('shipper_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->date('ship_date');
            $table->string('ship_status');
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
        Schema::dropIfExists('shippers');
    }
};
