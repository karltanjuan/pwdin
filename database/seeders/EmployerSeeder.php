<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Employer;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Manila');
        $user = [
            [
                'username'          => 'employer1',
                'email'             => 'employer1@gmail.com',
                'password'          => Hash::make('Qwerty123!', ['rounds' => '12']),
                'contact_person'    => 'Employer John',
                'mobile_no'         => '09123456789',
                'company_name'      => 'Cool Company',
                'address'           => 'BGC Taguig',
                'province'          => 'Metro Manila',
                'city'              => 'Taguig',
                'zip_code'          => '1634',
                'summary'           => null,
                'company_logo'      => '123',
                'business_permit'   => '123',
                'bir_certificate'   => '123',
                'status'            => 0,
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => null 
            ],
        ];

        foreach ($user as $key => $value) {
            Employer::create($value);
        }
    }
}
