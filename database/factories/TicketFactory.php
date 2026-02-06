<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'customer_id' => Customer::factory(), //вдруг кастомера еще нету

          'subject' => $this->faker->sentence(3),
          'message' => $this->faker->paragraph(),
          'status'  => $this->faker->randomElement(['new', 'in_progress', 'completed']),
          'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
