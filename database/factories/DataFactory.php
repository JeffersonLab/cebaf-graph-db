<?php

namespace Database\Factories;

use App\Models\DataSet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Data>
 */
class DataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'data_set_id' => DataSet::factory(),
            'globals' => json_encode(["foo" => "bar"] ),
            'graph' => 'stores a blob',
        ];
    }
}
