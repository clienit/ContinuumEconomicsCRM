<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->unique()->firstName,
            'last_name' => $this->faker->unique()->lastName,
            'avatar' => 'images/logo.png',
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
