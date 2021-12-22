<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->foreign('merchant_id', 'merchant_fk_4592816')->references('id')->on('merchants');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id', 'package_fk_4592817')->references('id')->on('packages');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4592818')->references('id')->on('users');
            $table->unsignedBigInteger('servicer_id')->nullable();
            $table->foreign('servicer_id', 'servicer_fk_4592823')->references('id')->on('servicers');
        });
    }
}
