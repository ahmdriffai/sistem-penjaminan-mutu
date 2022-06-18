<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penelitian>
 */
class PenelitianFactory extends Factory
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
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_selesai' => $this->faker->date(),
            'sumber_dana' => $this->faker->company(),
            'jumlah' => 50000000,
            'sebagai' => 'Penulis 1',
            'publis' => false,
            'owner' => Dosen::factory()->create()->nidn,
        ];
    }
}
