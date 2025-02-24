<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'type', 'amount'];

    /**
     * Relationship: A transaction belongs to a customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
