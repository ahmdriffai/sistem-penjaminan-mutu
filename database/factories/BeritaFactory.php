<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->text(),
            'isi' => $this->faker->text(),
            'penulis' => $this->faker->userName(),
            'gambar_path' => null,
            'gambar_url' => $this->faker->imageUrl(),
        ];
    }
}
