<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenelitianFactory extends Factory
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
            'publikasi'=>$this->faker->randomElement(['journal article','journal','article']),
            'tahun'=>$this->faker->date('Y'),
            'file'=>'https://source.unsplash.com/700x400/?'.$this->faker->randomElement(['sakura','sunflower','rose']),
            'category'=>$this->faker->randomElement(['Mahasiswa','Dosen','Tendik']),
            'slug'=>$this->faker->slug(),
            'abstract'=>$this->faker->paragraph(mt_rand(10,25))
        ];
    }
}
