<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{

    // protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id'             => 1,
            'job_title'               => $this->faker->jobTitle,
            'job_description'         => "<p>".$this->faker->sentence."</p>",
            'career_level'            => $this->faker->randomElement(['Intern Level', 'Entry Level', 'Associate Level', 'Mid-Senior Level', 'Director']),
            'job_type'                => $this->faker->randomElement(['Full-time', 'Part-time', 'Internship', 'Contract']),
            'years_experience'        => $this->faker->numberBetween(0, 10),
            'job_industry'            => $this->faker->randomElement(['Accounting/Finance', 'Admin/Human Resources', 'Sales/Marketing', 'Arts/Media/Communication', 'Services', 'Hotel/Restaurant', 'Education/Training', 'Computer/Information Technology', 'Engineering', 'Manufacturing', 'uilding/Construction', 'Sciences', 'Healtcare', 'Journalist/Editors', 'General Work', 'Publishing', 'Others']),
            'average_processing_time' => $this->faker->numberBetween(1, 30),
            'salary'                  => $this->faker->numberBetween(15000, 100000),
            'working_days'            => implode(',', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'pwd_categories'          => implode(',', ['All', 'Learning']),
            'qualification'           => $this->faker->randomElement(['Grade School', 'High School', "Bachelor's Degree", 'Vocational', 'Post-Graduate', 'Others']),
            'work_setup'              => $this->faker->randomElement(['Onsite', 'Remote', 'Hybrid']),
            'status'                  => 1 //$this->faker->boolean,
        ];
    }

}
