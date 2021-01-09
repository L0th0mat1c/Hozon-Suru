<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use App\Models\Seller;
use App\Models\Categorie;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/* Loic => Factory  de Seller pour la création de la base test avec DatabaseSeeder */

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { /* Modéle de création d'un seller  */
        return [
            
        ];
    }
}
