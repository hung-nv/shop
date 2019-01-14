<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
//            $table->integer('member_id')->unsigned()->nullable();
//            $table->foreign('member_id')->references('id')->on('members');
//            $table->integer('billing_address_id')->unsigned();
//            $table->foreign('billing_address_id')->references('id')->on('member_information');
//            $table->integer('shipping_address_id')->unsigned();
//            $table->foreign('shipping_address_id')->references('id')->on('member_information');
            $table->integer('total_money')->default(0);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone', 50)->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(1)->comment('1.wait confirm 2.approved 3.finish 4.cancel');
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
        Schema::drop('orders');
    }
}
