<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => '', // optional
            'level' => 10,
        ]);

        DB::table('roles')->insert([
            'name' => 'Lecturer',
            'slug' => 'lecturer',
            'description' => '', // optional
            'level' => 5,
        ]);

        DB::table('roles')->insert([
            'name' => 'Student',
            'slug' => 'student',
            'description' => '', // optional
            'level' => 2,
        ]);
    }
}
