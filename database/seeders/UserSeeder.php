<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = UserType::getAdminValue()->id;

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'phone' => '40738627192',
            'address' => 'Quebec Liberty Street',
            'password' => Hash::make('password123'),
            'user_type_id' => $admin,
            'clinic_id' => null
        ]);
    }
}
