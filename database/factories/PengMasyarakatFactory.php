<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PengMasyarakatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama'=>$this->faker->name(),
            'judul'=>$this->faker->sentence(mt_rand(6,10)),
            'tempat'=>$this->faker->address(),
            'waktu'=>$this->faker->date('d M Y'),
            'category'=>$this->faker->randomElement(['Mahasiswa','Dosen','Tendik']),
        ];
    }
}
