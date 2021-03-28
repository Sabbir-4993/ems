<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id' => '1',
            'name' => 'Fahad',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rootadmin'),
            'mobile_number' => '01723669304',
            'address' => 'Moghbazar',
            'image' => 'avatar.png',
            'skill' => 'test',
            'blood_group' => 'B+',
            'marital_status' => '',
            'department_id' => '1',
            'designation' => '2',
            'join_date' => '2021-01-09',
            'salary' => '100000',
            'loan' => '0',
            'emp_type' => '1',
            'emp_status' => '1',
            'edu' => '',
            'edu_year' => '',
            'pre_work' => '',
            'pre_work_year' => '',
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Alif',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('rootemployee'),
            'mobile_number' => '01521463599',
            'address' => 'Moghbazar',
            'image' => 'avatar.png',
            'skill' => 'test',
            'blood_group' => 'B+',
            'marital_status' => '',
            'department_id' => '1',
            'designation' => '2',
            'join_date' => '2021-01-09',
            'salary' => '100000',
            'loan' => '0',
            'emp_type' => '1',
            'emp_status' => '1',
            'edu' => '',
            'edu_year' => '',
            'pre_work' => '',
            'pre_work_year' => '',
        ]);
    }
}
