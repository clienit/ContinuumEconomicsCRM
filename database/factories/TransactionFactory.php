<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => function() {
                return Client::factory()->create()->id;
            },
            'transaction_date' => $this->faker->date,
            'amount' => $this->faker->randomNumber
        ];
    }
}
