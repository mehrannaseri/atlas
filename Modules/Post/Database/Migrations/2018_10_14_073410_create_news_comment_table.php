<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->text('comment');
            $table->integer('user_id')->nullable();
            $table->string('commentator_name',50)->nullable();
            $table->string('commentator_email' , 60)->nullable();
            $table->timestamps();
        });

        DB::table('permissions')->insert(array(
            [
                'name'          => 'read comment',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'create comment',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'update comment',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'destroy comment',
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
        Schema::dropIfExists('comments');
    }
}
