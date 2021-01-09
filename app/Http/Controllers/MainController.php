<?php

namespace App\Http\Controllers;

use App\Mail\BucketConfirmation;
use App\Mail\BucketMail;
use App\Models\Card;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Location;
use App\Models\Categorie;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;

class MainController extends Controller
{
    
// Render the Administration's page vue_
    public function adminCrud()
    {
        if(!Auth::check()){
            return back();
        }
        else if(Auth::user()->is_admin){
            return Inertia::render('Admin/CrudDashboard');
        }else{
            return back();
        }
    }

    public function search()
    {

        $cards = Card::all()->where("display", 1);

        $categories = Categorie::all();
        $locations = Location::all();

        return Inertia::render('search', [           
            'cards' => $cards,
            'categories' => $categories,
            'locations' => $locations        
            ]);    
    }

    public function cardPage(Request $request) {
        if (Auth::user()) {
        $card = Card::where("id", request("id"))->get();
        $categorie = Categorie::where("id", request("category_id"))->get();
        $location = Location::where("id", request("location_id"))->get();

        return Inertia::render('CardView', [
            'card' => $card,
            'categorie' => $categorie,
            'location' => $location
        ]);

        }else{
            return Inertia::render('auth/login');
        }
        
    }



// Render the Client's profile vue_
    public function clientProfile()
    {
        //$currentProfile = Auth::user();
        return Inertia::render('Clients/Profile');
    }

// Render the Seller's profile vue_
    public function sellerProfile()
    {
        //$currentProfile = Auth::user();
        return Inertia::render('Sellers/Profile');
    }

    public function Homepage() {

        $card = Card::where("display", true)->orderByDesc('created_at')->take(4)->get();
        return Inertia::render('Homepage', [
            'cardsHome' => $card
        ]);
        return Inertia::render('Homepage');
    }

    public function Login() {

        return Inertia::render('auth/login');
    }

    public function register() {

        return Inertia::render('auth/register');
    }

    // Render the Site's About page vue_
    public function About()
    {
        return Inertia::render('About');
    }

    public function resetPassW() {

        return Inertia::render('auth/reset_password');
    }

    public function sendToken(Request $request) {
        // dd($request->email);
        $user = User::where('email', $request->email)->first();
        
        
        if (!isset($user->id)) {

            return response()->json(['error' => "L' Utilisateur n'existe pas chez Hozonsuru", 401]);
        }

        $token = Str::random(32);
        
        // dd($token);
        Mail::to($user)->send(new ResetPasswordMailable($token));
        // dd($token);
        
        $passwordReset = new PasswordReset();
        $passwordReset->email = $user->email;
        $passwordReset->token = $token;
        $passwordReset->save();
    }

    public function validateToken(Request $request) {

        $passwordReset = PasswordReset::where('token', $request->token)->first();

        if (!isset($passwordReset->email)) {

            return response()->json(['error' => 'Invalid token.'], 401);
        }

        $user = User::where('email', $passwordReset->email)->first();
        return response()->json($user, 200);
    }
    
    public function resetPassword(Request $request) {

        $user = user::find($request->id);

        $passwordReset = PasswordReset::where('email', $user->email)->first();
        $passwordReset->delete();

        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function sendReservation(Request $request) {
        // dd($request->email);
        $user = Auth::user();

        $seller = User::where('email', $request->email)->first();
        $card = Card::where('id', $request->id)->first();
        // dd($seller->phone_number);
        $token = rand(100000, 999999);

        $data = [
            $user->name,
            $user->email,
            $user->phone_number,
            $card->adress,
            $card->price,
            $card->articles_number,
            $card->start_time,
            $card->end_time,
            $token           
        ];
        $dataUser = [
            $card->title,
            $card->adress,
            $card->price,
            $seller->phone_number,
            $seller->name,
            $seller->email,
            $card->start_time,
            $card->end_time,
            $token   
        ];




        Mail::to($seller->email)->send(new BucketMail($data));

        Mail::to($user->email)->send(new BucketConfirmation($dataUser));
        
    }



}

