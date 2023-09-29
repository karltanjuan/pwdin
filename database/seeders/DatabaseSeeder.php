<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Artisan;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('optimize:clear');
        Artisan::call('storage:link');
        Artisan::call('db:seed', ['--class' => 'AdminSeeder']);
        Artisan::call('db:seed', ['--class' => 'EmployerSeeder']);
        Artisan::call('db:seed', ['--class' => 'JobSeeder']);
        Artisan::call('db:seed', ['--class' => 'AppStatusSeeder']);
        Artisan::call('db:seed', ['--class' => 'ApplicantSeeder']);
    }
}
