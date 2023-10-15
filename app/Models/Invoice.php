<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference_number',
        'employer_id',
        'product_name',
        'description',
        'quantity',
        'currency',
        'total_amount',
        'payment_method',
        'subscription_expired_at',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
