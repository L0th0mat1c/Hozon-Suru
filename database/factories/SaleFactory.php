<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Sale;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/* Loic => Factory  de Sale pour la création de la base test avec DatabaseSeeder */

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   /* Modéle de création d'une sale */
        return [
            // 'seller_id' => Seller::all()->random()->id,
            // 'user_id' => User::all()->random()->id,
            // 'card_id' => Card::all()->random()->id
        ];
    }
}
