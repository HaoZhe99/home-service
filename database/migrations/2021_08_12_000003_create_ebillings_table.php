<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbillingsTable extends Migration
{
    public function up()
    {
        Schema::create('ebillings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('money', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
