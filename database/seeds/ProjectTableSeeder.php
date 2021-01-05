<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'project_name' => 'EGMCL',
            'company_name' => 'Epic Garments',
            'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.',
            'project_ref' => 'EG-AS136426-EP-001',
            'company_email' => 'info@egmcl.com',
            'address' => 'Baipayl, Dhaka',
            'phone' => '0123456789',
            'project_leader' => 'Md Hannan',
            'status' => '1',
            'est_budget' => '10000',
            'total_amount' => '0',
            'pro_duration' => '36',
            'project_start' => '2021-1-01',
            'project_end' => '2021-1-31',
            'created_at' => '2021-1-01',
            'updated_at' => '2021-1-01',

        ]);

    }
}
