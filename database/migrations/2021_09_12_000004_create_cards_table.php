<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bank_of_card')->nullable();
            $table->string('name_of_card')->nullable();
            $table->string('card_number')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('cvv')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
