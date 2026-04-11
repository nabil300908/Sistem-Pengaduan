<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    User::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    User::create([
        'name'     => 'Admin Sarpras',
        'email'    => 'admin@sekolah.com',
        'password' => Hash::make('password123'),
        'role'     => 'admin',
    ]);

}
}