<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Sale;
use App\Models\User;
use App\Models\Location;
use App\Models\Categorie;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $number = 40;
        
        $user = new \App\Models\User();
        $user->name = "Admin";
        $user->is_seller = false;
        $user->email = "admin@hozon.com";
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->is_admin = true;
        $user->save();

        User::factory($number)->create();

        for($i = 1; $i < 20; $i++) {
            $user = new \App\Models\User();
            $user->name = "Client". rand(100,1000);
            $user->is_seller = false;
            $user->email = Str::random(8). "@client.com";
            $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
            // 'password' => Hash::make('password'),
            $user->phone_number= mt_rand();
            $user->remember_token = Str::random(10);
            $user->is_admin = false;
            $user->save();
        };

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Boulangerie";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Fast-food";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Pizzeria";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Asiatique";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Exotique";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Italien";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Moyen-orient";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Patisserie";
        $Categorie->save();

        $Categorie = new \App\Models\Categorie();
        $Categorie->name = "Mixte";
        $Categorie->save();


        $Location = new \App\Models\Location();
        $Location->name = "Toulouse nord";
        $Location->zip = "31200";
        $Location->save();

        $Location = new \App\Models\Location();
        $Location->name = "Toulouse ouest";
        $Location->zip = "31500";
        $Location->save();

        $Location = new \App\Models\Location();
        $Location->name = "Toulouse sud-ouest";
        $Location->zip = "31400";
        $Location->save();

        $Location = new \App\Models\Location();
        $Location->name = "Toulouse sud-est";
        $Location->zip = "31100";
        $Location->save();

        $Location = new \App\Models\Location();
        $Location->name = "Toulouse est";
        $Location->zip = "31300";
        $Location->save();

        $Location = new \App\Models\Location();
        $Location->name = "Toulouse centre";
        $Location->zip = "31000";
        $Location->save();
        

        // for($i = 1; $i < $number; $i++) {
        //     $Seller = new \App\Models\Seller();
        //     $Seller->user_id = $i;
        //     $Seller->location_id = Location::all()->random()->id;
        //     $Seller->adress = rand(1,50) . Arr::random([" rue ", " avenue ", " Boulevard ", " route ", " chemin "]) . Str::random(10);
        //     $Seller->category_id = Categorie::all()->random()->id;
        //     $Seller->siret_number = "S n°".Str::random(10);
        //     $Seller->save();
        //     };    

        for($i = 1; $i < $number-20; $i++) {
            $Card = new \App\Models\Card();
            // $Card->seller_id = $i;
            $Card->title = Arr::random(["Pains", "Hambergers maison", "Pizzas orientales", "Pains au chocolats", "Sushis", "Kebabs", "Plateaux repas mixtes", "Riz cantonnais", "Sandwichs"]);
            $Card->price = rand(2, 35);
            $Card->background_image = Arr::random(['https://i.imgur.com/O0wR2Iw.jpg','https://i.imgur.com/S1cvpTt.jpg', 'https://i.imgur.com/WaECyc5.jpg', 'https://i.imgur.com/EyMWjfc.jpg', 'https://i.imgur.com/7UhS0bf.jpg', 'https://i.imgur.com/gOYvFHt.jpg', 'https://i.imgur.com/xxwJTFm.jpg']);
            $Card->description = "Quid enim tam absurdum quam delectari multis inanimis rebus, ut honore, ut gloria, ut aedificio, ut vestitu cultuque corporis, animante virtute praedito, eo qui vel amare vel, ut ita dicam, redamare possit, non admodum delectari? Nihil est enim remuneratione benevolentiae, nihil vicissitudine studiorum officiorumque iucundius.";

            $Card->articles_number = rand(2, 15);
            $Card->display = true;
            $Card->user_id = $i;
            $Card->location_id = Location::all()->random()->id;
            $Card->adress = rand(1,50) . Arr::random([" rue ", " avenue ", " Boulevard ", " route ", " chemin "]) . Str::random(10);
            $Card->category_id = Categorie::all()->random()->id;
            $Card->siret_number = "S n°".Str::random(10);
            $Card->start_time = "18:00";
            $Card->end_time = "22:30";
            $Card->save();

        }
        for($i = $number-20; $i < $number-10; $i++) {
            $Card = new \App\Models\Card();
            // $Card->seller_id = $i;
            $Card->title = Arr::random(["Pains", "Hambergers maison", "Pizzas orientales", "Pains au chocolats", "Sushis", "Kebabs", "Plateaux repas mixtes", "Riz cantonnais", "Sandwichs"]);
            $Card->price = rand(2, 35);
            $Card->background_image = Arr::random(['https://i.imgur.com/O0wR2Iw.jpg','https://i.imgur.com/S1cvpTt.jpg', 'https://i.imgur.com/WaECyc5.jpg', 'https://i.imgur.com/EyMWjfc.jpg', 'https://i.imgur.com/7UhS0bf.jpg', 'https://i.imgur.com/gOYvFHt.jpg', 'https://i.imgur.com/xxwJTFm.jpg']);
            $Card->description = Str::random(150);
            $Card->articles_number = rand(2, 15);
            $Card->display = false;
            $Card->user_id = $i;
            $Card->location_id = Location::all()->random()->id;
            $Card->adress = rand(1,50) . Arr::random([" rue ", " avenue ", " Boulevard ", " route ", " chemin "]) . Str::random(10);
            $Card->category_id = Categorie::all()->random()->id;
            $Card->siret_number = "S n°".Str::random(10);
            $Card->save();

        }

        // Seller::factory(30)->create();
        
        
    }
}