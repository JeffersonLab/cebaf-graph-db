<?php

namespace Database\Factories;

use App\Models\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSet>
 */
class DataSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'config_id' => Config::factory(),
            'begin_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
            'mya_deployment' => 'history',
            'comments' => $this->faker->text(),

        ];
    }
}
