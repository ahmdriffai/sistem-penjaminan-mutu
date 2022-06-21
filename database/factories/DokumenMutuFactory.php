<?php

namespace Database\Factories;

use App\Models\PenjaminanMutu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DokumenMutu>
 */
class DokumenMutuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_dokumen' => uniqid(),
            'nama' => $this->faker->name(),
            'tahun' => $this->faker->year(),
            'deskripsi' => $this->faker->text(),
            'penjaminan_mutu_id' => PenjaminanMutu::factory()->create()->id
        ];
    }
}
