<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Newsletter',function (Blueprint $table){
           $table->increments('id');
           $table->string('email');
           $table->string('unsubscribe_reason')->nullable();
           $table->boolean('subscribed')->default(true);
           $table->timestamp('created_at');
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
        Schema::dropIfExists('newsletter');
    }
}
