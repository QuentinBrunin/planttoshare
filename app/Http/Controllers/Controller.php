<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function welcolm(){
        $annonces =Annonce::with('createur')->latest()->take(4)->get();

        foreach ($annonces as $annonce) {
            $user = User::find($annonce->createur);

            if ($user && $user->pseudo) {
                $annonce->auteur_nom = $user->pseudo;
            } elseif ($user) {
                
                $prenom = $user->prenom;
                $nom = $user->nom ? substr($user->nom, 0, 1) : '';
                $annonce->auteur_nom = $prenom . ($nom ? (' ' . $nom . '.') : '');
            } 
            else {
                $annonce->auteur_nom = 'Auteur inconnu';
            }
        }

        return view('layouts.main', compact('annonces'));
            }
    
    public function index(){
        $annonces =Annonce::latest()->take(20)->get();
        return view('layouts.allDonation',compact('annonces'));
    }
}
