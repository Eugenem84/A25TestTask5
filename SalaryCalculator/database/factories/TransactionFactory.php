<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'employee_id' => $this->faker->randomNumber(1, 10),
            'hours' => $this->faker->numberBetween(1,9),
        ];
    }
}
