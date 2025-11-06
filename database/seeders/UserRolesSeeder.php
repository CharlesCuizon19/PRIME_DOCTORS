<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user and role IDs
        $userId = DB::table('users')->where('email', 'hello@rweb.solutions')->value('id');
        $roleId = DB::table('roles')->where('role_name', 'admin')->value('id');

        DB::table('user_roles')->insert([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);
    }
}
