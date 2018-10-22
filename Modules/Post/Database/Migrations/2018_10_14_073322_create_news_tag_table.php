<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',40);
            $table->integer('lang_id')->unsigned()->index();
            $table->timestamps();
        });

        DB::table('permissions')->insert(array(
            [
                'name'          => 'read tag',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'create tag',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'update tag',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'destroy tag',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ));

        Schema::create('post_tag',function (Blueprint $table){
            $table->integer('post_id');
            $table->integer('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
    }
}
