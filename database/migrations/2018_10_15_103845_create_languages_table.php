<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',35);
            $table->char('flag' , 2);
            $table->timestamps();
        });

        DB::table('permissions')->insert(array(
            [
                'name'          => 'read language',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'create language',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated-at'    => now()
            ],
            [
                'name'          => 'update language',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'destroy language',
                'guard_name'    => 'web',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ));

        DB::table('languages')->insert(
            array(
                'title' => 'english',
                'flag'  => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
