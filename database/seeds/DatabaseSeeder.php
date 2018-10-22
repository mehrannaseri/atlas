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
            'name'=>'add news',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'edit news',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'delete news',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'add category',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'edit category',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'delete category',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'add tag',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'edit tag',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
        ],[
            'name'=>'delete tag',
            'guard_name'=>'web',
            'created_at'=>now(),
            'updated_at'=>now(),
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
