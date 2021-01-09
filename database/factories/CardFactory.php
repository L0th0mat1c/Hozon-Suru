<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

/* Loic => Factory  de Card pour la création de la base test avec DatabaseSeeder */

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   /* Modéle de création d'une card */
        return [
            'title' => $this->faker->sentence(),
            'price' => rand(2, 10),
            'description' => $this->faker->text(),
            'articles_number' => rand(2, 10),
            'display' => true

        ];
    }
}
