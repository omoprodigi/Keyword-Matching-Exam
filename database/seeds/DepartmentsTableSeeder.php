<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => "Computer Science",
            'code' => '10',
            'faculty_id' => '1',
        ]);

        DB::table('departments')->insert([
            'name' => "Mathematics",
            'code' => '12',
            'faculty_id' => '1',
        ]);

        DB::table('departments')->insert([
            'name' => "Physics",
            'code' => '13',
            'faculty_id' => '1',
        ]);

        DB::table('departments')->insert([
            'name' => "English",
            'code' => '21',
            'faculty_id' => '2',
        ]);

        DB::table('departments')->insert([
            'name' => "Philosophy",
            'code' => '22',
            'faculty_id' => '2',
        ]);
    }
}
