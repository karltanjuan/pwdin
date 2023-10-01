<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ApplicationStatus;

class Employer extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'contact_person',
        'mobile_no',
        'address',
        'province',
        'city',
        'zip_code',
        'summary',
        'company_logo',
        'business_permit',
        'bir_certificate',
        'status',
        'email_verified_at',
        'token',
        'token_expired_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        // Not required
    }

    public function setRememberToken($value)
    {
        // Not required
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function application_statuses()
    {
        return $this->hasOne(ApplicationStatus::class);
    }
}
