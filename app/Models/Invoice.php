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
        'job_id',
        'customer_id',
        'product_name',
        'description',
        'quantity',
        'currency',
        'total_amount',
        'payment_method'
    ];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
