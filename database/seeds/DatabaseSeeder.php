<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        
        $this->call(FacultiessTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);

        $this->call(UsersTableSeeder::class);

        Model::reguard();
    }
}
