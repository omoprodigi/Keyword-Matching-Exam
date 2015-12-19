<?php

use Illuminate\Database\Seeder;

class FacultiessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            'name' => "Sciences",
            'code' => '01',
        ]);

        DB::table('faculties')->insert([
            'name' => "Arts",
            'code' => '02',
        ]);
    }
}
