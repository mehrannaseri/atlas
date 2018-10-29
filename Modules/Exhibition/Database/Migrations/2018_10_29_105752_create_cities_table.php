<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id');
            $table->string('title');
            $table->timestamps();
        });

        DB::table('states')->insert([
            'title'      => 'kurdistan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cities')->insert(array(
            [
                'state_id'   => 1,
                'title'      => 'Erbil',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'state_id'   => 1,
                'title'      => 'Hawler',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'state_id'   => 1,
                'title'      => 'Sulaymaniyah‎',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'state_id'   => 1,
                'title'      => 'Ranya',
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
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
}
