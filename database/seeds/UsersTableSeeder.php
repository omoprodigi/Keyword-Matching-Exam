<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Super Admin",
            'email' => 'super_admin@exams.com',
            'password' => bcrypt('mypassword'),
            'department_id' =>'1',
        ]);

        DB::table('users')->insert([
            'name' => "Lecturer Black",
            'email' => 'lblack@schools.com',
            'password' => bcrypt('mypassword'),
            'department_id' =>'1',
        ]);

        DB::table('users')->insert([
            'name' => "Student Blue",
            'email' => 'sblue@schools.com',
            'password' => bcrypt('mypassword'),
            'department_id' =>'1',
        ]);

        $adminRole = Role::find(1);

        $user = User::find(1);

        $user->attachRole($adminRole);

         $lecturerRole = Role::find(2);

        $userlecturer = User::find(2);

        $userlecturer->attachRole($lecturerRole);

         $studentRole = Role::find(3);

        $userStudent = User::find(3);

        $userStudent->attachRole($studentRole);
        

    }
}
