<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $permissions = array([
            'name'       =>'read language',
            'guard_name' =>'web',
            'created_at' =>now(),
            'updated_at' =>now(),
        ],[
            'name'       =>'create language',
            'guard_name' =>'web',
            'created_at' =>now(),
            'updated_at' =>now(),
        ],[
            'name'          =>'update language',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'delete language',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'read news',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'create news',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'update news',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'delete news',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'read category',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'create category',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'update category',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'delete category',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'read tag',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'create tag',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'update tag',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ],[
            'name'          =>'delete tag',
            'guard_name'    =>'web',
            'created_at'    =>now(),
            'updated_at'    =>now(),
        ]);

        DB::table('permissions')->delete();
        foreach ($permissions as $permission) {

            Permission::create([
                'name'       => $permission['name'],
                'guard_name' => $permission['guard_name'],
            ]);

        }
    }
}
