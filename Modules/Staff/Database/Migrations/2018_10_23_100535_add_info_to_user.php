<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lname')->nullable()->after('name');
            $table->string('mobile' , 14)->nullable()->after('lname');
            $table->text('avatar')->nullable()->after('mobile');
        });

        DB::table('permissions')->insert(array(
            [
                'name'       => 'read staff',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'create staff',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'update staff',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'destroy staff',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'access level',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fname');
            $table->dropColumn('mobile');
            $table->dropColumn('avatar');
        });
    }
}
