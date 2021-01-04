<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designations')->insert([
            'name' => 'CEO',
            'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.',
        ]);

        DB::table('designations')->insert([
            'name' => 'Admin Manager',
            'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.',
        ]);

        DB::table('designations')->insert([
            'name' => 'System Admin',
            'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.',
        ]);

        DB::table('designations')->insert([
            'name' => 'Web Developer',
            'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.',
        ]);

        DB::table('designations')->insert([
            'name' => 'Project Coordinator',
            'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.',
        ]);
    }
}
