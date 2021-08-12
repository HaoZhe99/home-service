<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMerchantPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_merchant', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id');
            $table->foreign('merchant_id', 'merchant_id_fk_4592877')->references('id')->on('merchants')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_4592877')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
