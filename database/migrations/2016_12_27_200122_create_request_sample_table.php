<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSampleTable extends Migration
{
    public function up()
    {
        Schema::create('request_sample', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->unsignedInteger('request_id');
            $table->foreign('sample_id')->references('id')->on('samples');
            $table->foreign('request_id')->references('id')->on('requests');
            $table->float('quantity', 7, 3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_sample');
    }
}
