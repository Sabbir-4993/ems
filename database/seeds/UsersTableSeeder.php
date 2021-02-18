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
            'name' => 'Niloy',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rootadmin@2021'),
        ]);
    }
}
