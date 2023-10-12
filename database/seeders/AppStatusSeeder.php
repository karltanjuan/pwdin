<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ApplicationStatus;

class AppStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Manila');

        $status = [
           [
                'employer_id' => 1,
                'name' => json_encode(['Initial Interview', 'Exam', 'Final Interview', 'Hired', 'Rejected']),
           ]
        ];

        foreach ($status as $key => $value) {
            ApplicationStatus::create($value);
        }
    }
}