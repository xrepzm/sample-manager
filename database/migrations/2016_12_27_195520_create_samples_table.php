<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('charge', 32)->index();
            $table->unsignedInteger('productcode')->index();
            $table->unsignedInteger('itemcode')->unique();
            $table->string('productname', 64)->index();
            $table->float('quantity', 7, 3);
            $table->string('unit', 8);
            $table->date('sampled_at');
            $table->date('expiry')->index();
            $table->date('rejected_at')->nullable();
            $table->timestamps();

            $table->unique(['charge', 'productcode']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('samples');
    }
}
