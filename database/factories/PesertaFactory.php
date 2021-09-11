<?php

namespace Database\Factories;

use App\Models\Peserta;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesertaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Peserta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nomor_wa' => $this->faker->phoneNumber(),
            'pekerjaan' =>$this->faker->jobTitle(),
            'instansi' => $this->faker->company(),
            'domisili' => $this->faker->city()
        ];
    }
}
