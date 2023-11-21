<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Manila');

        $pwd_categories = ['Psychosocial', 'Mental', 'Chronic illness', 'Learning', 'Visual', 'Orthopedic', 'Physical', 'Communication','Deaf/Hard of Hearing','Intellectual', 'Speech and Language', 'Cancer','Rare Disease'];
        $pwd_category = $pwd_categories[array_rand($pwd_categories)];

        $user = [
            [

                'username'          => 'benteelador',
                'email'             => 'benteelador@gmail.com',
                'password'          => Hash::make('Qwerty123!', ['rounds' => '12']),
                'first_name'        => 'Ben',
                'middle_name'       => 'Tee',
                'last_name'         => 'Lador',
                'prefix'            => 'Jr.',
                'birthdate'         => '1990-01-01',
                'gender'            => 'Male',
                'mobile_no'         => '09123456789',
                'education_level'   => 'College',
                'address'           => '#123 Test Address',
                'province'          => 'Metro Manila',
                'city'              => 'Manila',
                'summary'           => null,
                'zip_code'          => '1234',
                'profile_photo'     => '',
                'resume'            => '',
                'pwd_card'          => '',
                'status'            => 1,
                'pwd_categories'    => $pwd_category,
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => null 
            ],
            [

                'username'          => 'janedeleon',
                'email'             => 'janedeleon@gmail.com',
                'password'          => Hash::make('Qwerty123!', ['rounds' => '12']),
                'first_name'        => 'Jane',
                'middle_name'       => 'De',
                'last_name'         => 'Leon',
                'prefix'            => '',
                'birthdate'         => '1990-01-01',
                'gender'            => 'Female',
                'mobile_no'         => '09123456788',
                'education_level'   => 'College',
                'address'           => '#654 Test Address',
                'province'          => 'Metro Manila',
                'city'              => 'Taguig',
                'summary'           => null,
                'zip_code'          => '1234',
                'profile_photo'     => '',
                'resume'            => '',
                'pwd_card'          => '',
                'status'            => 1,
                'pwd_categories'    => $pwd_category,
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => null 
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
