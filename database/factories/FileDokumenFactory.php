<?php

namespace Database\Factories;

use App\Models\DokumenMutu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FileDokumen>
 */
class FileDokumenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_file' => $this->faker->name(),
            'file_path' => null,
            'file_url' => null,
            'format' => null,
            'dokumen_mutu_id' => DokumenMutu::factory()->create()->id,
        ];
    }
}
