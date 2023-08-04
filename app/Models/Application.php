<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\Applicant;

class Application extends Model 
{
    use HasFactory;

    protected $table = 'applications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_id',
        'applicant_id',
        'cover_letter',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

}
