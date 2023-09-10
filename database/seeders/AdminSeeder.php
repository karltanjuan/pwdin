<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This is an associative array (key-value pair)
        $user = [
            [
                'first_name'        => 'John',
                'middle_name'       => 'Smith',
                'last_name'         => 'Doe',
                'prefix'            => null,
                'email'             => 'johndoe@gmail.com',
                'username'          => 'johndoe',
                'password'          => Hash::make('aDmin123@', ['rounds' => '12']),
                'mobile_no'         => '09123456789',
                'profile_photo'     => null,
                'role'              => 1, // 1 = admin, 2 = staff
                'status'            => 1, // 1 = active, 2 = inactive
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => date('Y-m-d H:i:s') // now
            ],
            [
                'email'             => 'janedee@gmail.com',
                'username'          => 'janedee',
                'password'          => Hash::make('sTaff123@', ['rounds' => '12']),
                'mobile_no'         => '09123456788',
                'first_name'        => 'Jane',
                'middle_name'       => 'Dee',
                'last_name'         => 'Buffalo',
                'prefix'            => null,
                'profile_photo'     => null,
                'role'              => 2, // 1 = admin, 2 = staff
                'status'            => 1, // 1 = active, 2 = inactive
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => date('Y-m-d H:i:s') // now
            ],
        ];
  
        foreach ($user as $key => $value) {
            // class::method($param);
            // double colon means static method in PHP
            Admin::create($value);
        }

        // command: php artisan db:seed --class=AdminSeeder
    }
}
