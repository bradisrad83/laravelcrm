<?php

use Illuminate\Database\Seeder;
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
        //
        $adminUser = new User();
        $adminUser->name = 'Admin Test';
        $adminUser->email = 'admin@site.com';
        $adminUser->password = bcrypt('password');
        $adminUser->role_id = 1;
        $adminUser->save();

        $managerUser = new User();
        $managerUser->name = 'Manager Test';
        $managerUser->email = 'manager@site.com';
        $managerUser->password = bcrypt('password');
        $managerUser->role_id = 2;
        $managerUser->save();

    }
}
