<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nidn' => uniqid(),
            'nama' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'nik' => uniqid(),
            'jenis_kelamin' => 'L',
            'nomer_hp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'foto_url' => null,
            'foto_path' => null,
            'user_id' => null,
        ];
    }
}
