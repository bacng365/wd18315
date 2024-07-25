<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->user_id,
            'totalPrice' => $this->faker->randomFloat(2, 500, 2000),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime
        ];

        // protected $fillable = [
        //     'user_id',
        //     'totalPrice',
        // ];
    }
}
