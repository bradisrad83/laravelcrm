<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->description = 'Can create/update/delete all employees/companies';
        $adminRole->save();

        $managerRole = new Role();
        $managerRole->name = 'manager';
        $managerRole->description = 'Can only update the company they have been assigned too.  The also have full CRUD for employees for their company';
        $managerRole->save();
    }
}
