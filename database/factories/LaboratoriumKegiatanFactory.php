<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoriumKegiatanFactory extends Factory
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
            'judul'=>$this->faker->sentence(mt_rand(6,10)),
            'waktu'=>$this->faker->date('d M Y'),
            // 'lab'=>mt_rand(0,3),
            // 'kegiatan' =>$this->faker->randomElement(['penelitian','praktikum','proyek-akhir','pengujian','perlombaan']), 
            // 'category'=>$this->faker->randomElement(['Mahasiswa','Dosen','Tendik']),
            'laboratorium_id'=>mt_rand(1,4),
            'category_kegiatan_id' =>mt_rand(1,5),
            'category_id'=>mt_rand(2,4),
        ];
    }
}
