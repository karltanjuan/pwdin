<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employer;

class Job extends Model 
{
    use HasFactory;

    protected $table = 'jobs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_title',
        'job_description',
        'career_level',
        'job_type',
        'years_experience',
        'job_industry',
        'average_processing_time',
        'salary',
        'working_days',
        'qualification',
        'work_setup',
        'status'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

}
