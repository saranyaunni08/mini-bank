<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'type' => $this->faker->randomElement(['Credited', 'Debited']),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
