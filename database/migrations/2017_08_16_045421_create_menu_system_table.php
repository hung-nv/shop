<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_system', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('label');
            $table->string('icon');
            $table->string('route');
            $table->integer('parent_id');
            $table->tinyInteger('sort')->default(0);
            $table->string('show')->default('1,2');
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_system');
    }
}
