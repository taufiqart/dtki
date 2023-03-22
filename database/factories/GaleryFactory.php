<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GaleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(mt_rand(6,10)),
            'image'=>'https://source.unsplash.com/700x400/?'.$this->faker->randomElement(['sakura','sunflower','rose']),
            'profil_lab_id'=>mt_rand(1,4),
            'profil_id'=>mt_rand(1,3)
        ];
    }
}
