<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'designation_id' => '1',
            'user_id' => '1',
            'name' => '{"department":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"permission":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"designation":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"user":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"project":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"project_work_order":{"can-add":"1","can-view":"1","can-list":"1"},"contractors":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"contractor_bill":{"can-add":"1","can-edit":"1","can-report":"1","can-view":"1","can-list":"1"},"vendor":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"vendor_bill":{"can-add":"1","can-report":"1","can-view":"1","can-list":"1"},"material":{"can-add":"1","can-edit":"1","can-view":"1","can-list":"1"},"requisition":{"can-add":"1","can-edit":"1","can-pending":"1","can-approve":"1","can-list":"1"}}'
        ]);
    }
}
