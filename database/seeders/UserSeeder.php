<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo admin
        User::create([
        	'name' => 'Admin',
        	'username' => 'admin',
        	'password' => bcrypt('123123123'),
        	'unit_id' => null,
        ]);
    }
}
