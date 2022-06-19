<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaperIlmiah>
 */
class PaperIlmiahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->title(),
            'tahun' => $this->faker->year,
            'bulan' => $this->faker->month(),
            'media' => $this->faker->text(),
            'issn' => $this->faker->randomNumber(),
            'sebagai' => 'Penulis 1',
            'indexs' => 'corpus',
            'kriteria' => 'jurnal internasional',
            'link' => $this->faker->url(),
            'owner' => Dosen::factory()->create()->nidn,
        ];
    }
}
