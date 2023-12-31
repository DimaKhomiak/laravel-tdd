<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     *  @var string
     */
    protected $model = Property::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->title,
            'type' => $this->faker->word,
            'price' => $this->faker->randomNumber(6),
            'description' => $this->faker->paragraph,
        ];
    }
}
