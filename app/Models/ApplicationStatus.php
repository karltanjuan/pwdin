<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employer;

class ApplicationStatus extends Model 
{
    use HasFactory;

    protected $table = 'application_statuses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employer_id',
        'name',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

}
