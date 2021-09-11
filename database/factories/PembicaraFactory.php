<?php

namespace Database\Factories;

use App\Models\Pembicara;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembicaraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembicara::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'deskripsi' => $this->faker->paragraphs(5,true)
        ];
    }
}
