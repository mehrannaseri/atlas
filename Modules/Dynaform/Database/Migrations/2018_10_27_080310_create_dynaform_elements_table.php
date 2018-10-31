<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynaformElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynaform_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->string('type');
            $table->string('title');
            $table->string('style')->nullable();
            $table->tinyInteger('priority')->default(1);
            $table->tinyInteger('required')->default(0);
            $table->timestamps();
        });

        Schema::create('dynaform_values',function (Blueprint $table){
            $table->increments('id');
            $table->integer('element_id');
            $table->string('user_ip');
            $table->string('value');
            $table->integer('fid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynaform_elements');
        Schema::dropIfExists('dynaform_values');
    }
}
