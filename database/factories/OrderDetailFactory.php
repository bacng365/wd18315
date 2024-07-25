<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'order_id' => Order::all()->random()->order_id,
            'order_id' => Order::inRandomOrder()->first()->order_id,
            'product_id' => Product::inRandomOrder()->first()->product_id,
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 500, 2000),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime
        ];

        // protected $fillable = [
        //     'order_id',
        //     'product_id',
        //     'quantity',
        //     'price',
        // ];
    }
}
