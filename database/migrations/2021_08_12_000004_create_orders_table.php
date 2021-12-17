<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('address')->nullable();
            $table->string('comment')->nullable();
            $table->integer('rate')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
