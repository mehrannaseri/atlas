<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('posts',function (Blueprint $table){
           $table->increments('id');
           $table->string('title',250);
           $table->text('body');
           $table->integer('lang_id')->unsigned()->index();
           $table->integer('user_id');
           $table->timestamps();
        });

        DB::table('permissions')->insert(array(
            [
                'name'          => 'read post',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'create post',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'update post',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'destroy post',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('posts');
    }
}
