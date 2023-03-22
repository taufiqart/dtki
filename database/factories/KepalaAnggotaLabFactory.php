<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KepalaAnggotaLabFactory extends Factory
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
			'jabatan'=>$this->faker->randomElement(['penelitian','praktikum','proyek-akhir','pengujian','perlombaan']),
			'role_name' => 'Anggota Lab',
            'image'=>'https://source.unsplash.com/700x400/?'.$this->faker->randomElement(['sakura','sunflower','rose']),
			'laboratorium_id' => mt_rand(1,4)
		];
	}
}
