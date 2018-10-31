<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExceptionErrorHandler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exceptions',function (Blueprint $table){
           $table->increments('id');
           $table->text('message');
           $table->string('url');
           $table->integer('line');
           $table->text('file');
           $table->integer('code');
           $table->timestamp('error_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('exceptions');
    }
}
