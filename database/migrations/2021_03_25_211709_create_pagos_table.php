<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->string("errorCode");
            $table->string("errorMessage");
            $table->string("orderNumber");   
            $table->string("orderStatus");   
            $table->string("actionCode");   
            $table->string("amount");   
            $table->string("date");   
            $table->string("ip");   
            $table->string("cardholderName");   
            $table->string("approvalCode");   
            $table->string("pan");   
            $table->string("authDateTime");   
            $table->string("terminalId");   
            $table->string("authRefNum");   
            $table->string("paymentState");   
            $table->string("approvedAmount");   
            $table->string("depositedAmount");   
            $table->string("refundedAmount");   
            $table->integer("shoppingcart")->unsigned();;   
            $table->integer("orderid")->unsigned();;   
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
        Schema::dropIfExists('pagos');
    }
}
