<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Berita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->text,
        'konten' => $this->faker->word,
        'penults' => $this->faker->text,
        'tanggal_terbit' => $this->faker->word
        ];
    }
}
