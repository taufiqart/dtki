<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerlombaanFactory extends Factory
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
            'slug'=>$this->faker->slug(),
            'image'=>'https://source.unsplash.com/700x400/?'.$this->faker->randomElement(['sakura','sunflower','rose']),
            'excerpt'=>$this->faker->paragraph(),
            'body'=>$this->faker->paragraph(mt_rand(10,25)),
            'category'=>$this->faker->randomElement(['Mahasiswa','Dosen','Tendik'])
        ];
    }
}
