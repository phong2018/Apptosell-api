<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        $role = Role::create(['name'     => 'admin']);
        $adminData = [
            'name'     => 'apptosell Admin',
            'email'    => 'admin@dln.net',
            'permission'     => 1,
            'role_id' => $role->id,
            'is_super_admin'     => 1,
            'password' => 'Admin123@'
        ];

        Admin::create($adminData);
    }
}
