<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class dosenTendikFactory extends Factory
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
            'nip'=>$this->faker->unique()->randomNumber(5, true),
            'email'=>$this->faker->email(),
            'jabatan'=>null,
            'profil_sinta'=>$this->faker->url(),
            'profil_scholar'=>$this->faker->url(),
            'image'=>'https://source.unsplash.com/700x400/?'.$this->faker->randomElement(['sakura','sunflower','rose']),
            'profil_file'=>null,
            'category'=>$this->faker->randomElement(['Dosen','Tendik'])
        ];
    }
}
