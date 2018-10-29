<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lang_id')->index()->unsigned();
            $table->integer('state_id')->index()->unsigned();
            $table->integer('city_id')->index()->unsigned();
            $table->string('title');
            $table->date('start_holding')->comment('تاریخ شروع برگزاری');
            $table->date('end_holding')->comment('تاریخ پایان نمایشگاه');
            $table->date('start_reg')->comment('تاریخ شروع ثبت نام');
            $table->date('end_reg')->comment('تاریخ پایان ثبت نام');
            $table->smallInteger('pavilion_num')->nullable();
            $table->text('address')->nullable();
            $table->integer('cpm')->nullable()->comment('cost per meter');
            $table->timestamps();
        });

        DB::table('permissions')->insert(array(
            [
                'name'          => 'read exhibition',
                'guard_name'    => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'          => 'create exhibition',
                'guard_name'    => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'          => 'update exhibition',
                'guard_name'    => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'          => 'destroy exhibition',
                'guard_name'    => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibition');
    }
}
