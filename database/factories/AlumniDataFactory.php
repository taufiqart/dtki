<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlumniDataFactory extends Factory
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
            'pekerjaan'=>$this->faker->company(),
            'alamat'=>$this->faker->address(),
            'no'=>$this->faker->phoneNumber(),
            'tahun'=>$this->faker->date('Y')
        ];
    }
}
