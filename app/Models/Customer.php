<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Transaction; // ✅ Import the Transaction model

class Customer extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['first_name','last_name', 'email', 'phone', 'balance'];

    /**
     * Relationship: A customer can have multiple transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the formatted balance.
     */
    public function getFormattedBalanceAttribute()
    {
        return number_format($this->balance, 2);
    }
}
