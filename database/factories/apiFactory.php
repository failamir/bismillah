<?php

namespace Database\Factories;

use App\Models\api;
use Illuminate\Database\Eloquent\Factories\Factory;

class apiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = api::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qwerty' => $this->faker->text,
        'asdf' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'laila_id' => $this->faker->randomDigitNotNull
        ];
    }
}
