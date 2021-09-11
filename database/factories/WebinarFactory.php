<?php

namespace Database\Factories;

use App\Models\Webinar;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebinarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Webinar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(10,false),
            'deskripsi' => $this->faker->paragraphs(10,true),
            'tgl_acara' => $this->faker->date(),
            'waktu_mulai' => $this->faker->time(),
            'waktu_selesai' => $this->faker->time(),
            'zoom'=> $this->faker->url(),
            'poster_img'=> $this->faker->imageUrl(360, 360, 'animals', true, 'dogs', true),
            'user_id'=> 1,
            'pembicara_id' => 1
        ];
    }
}
