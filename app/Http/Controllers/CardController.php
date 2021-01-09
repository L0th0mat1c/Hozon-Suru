<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Location;
use App\Models\Categorie;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

// Loic => Controller pour api sur le model Card

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request("search");
        $categorie_id = request("categorie_id");
        $location_id = request("location_id");
        $price = request("price");
        $display = request("display");
        

        if(!empty($search) || !empty($categorie_id) || !empty($location_id) || !empty($price) ) {
           
            if (!empty($search)) {
                $resultSearch = Card::where('title', 'LIKE', "%{$search}%")->where("display", true);
            }else{
                $resultSearch = Card::where("display", true)->orderByDesc('created_at');
                
            }
            if (!empty($categorie_id)) {
                $resultbyCategorie = $resultSearch->where("category_id", '=', $categorie_id);
            }else{
                $resultbyCategorie = $resultSearch;
            }

            if (!empty($location_id)) {
                $resultByLocation =  $resultbyCategorie->where("location_id", '=', $location_id);
                // dd($resultByLocation);
            }else{
                $resultByLocation = $resultbyCategorie;
            }

            if (!empty($price)) {
                if ($price <= 20){
                    $resultByPrice = $resultByLocation->where("price", "<", $price)->get();
                }else {
                    $resultByPrice = $resultByLocation->where("price", ">", $price)->get();
                }
                
            }else{
                $resultByPrice = $resultByLocation->get();
            }

            return $resultByPrice;
        }else if($display == "all"){

            return Card::all();
            
        }else{

            return Card::where("display", true)->orderByDesc('created_at')->get();

        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       if (Card::create($request->all())) {
            return response()->json([
                'success' => "Card de vente crée avec succès"
            ]);
       };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return $card;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        if ($card->update($request->all())) {
            return response()->json([
                'success' => "Carte de vente modifiée avec succès"
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();
    }

    public function search() {

        $search = request("search");
        if (!in_array($search, ['search'])) {
            $search = 'search';
            DD($search);
        }

        
        $categorie_id = request("categorie_id");
        if (!in_array($categorie_id, [])) {
            $categorie_id = '';
        }

        $location_id = request("location_id");
        if (!in_array($location_id, ['q'])) {
            $search = 'q';
        }

        DD($location_id);
    }
}