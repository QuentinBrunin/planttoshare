<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index(){
        $user = auth()->user();
        $annonces = $user->annonces;
        return view('profil.annonces.index',['annonces' =>$annonces]);
    }
    public function create()
    {
        return view('profil.annonces.create');
    }

    public function store(Request $request)
    {
        $data =$request->validate([
            'titre' => 'required|max:150',
            'descriptif' => 'required|max:550',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'etat' => 'required'
        ]);

        $image =$data['image'];
        if($image != null && !$image->getError()){
            $data['image'] =$image->store('dossier_images','public');
        }

        $etat = $request->input('etat');
        $user =auth()->user();
        $createur = $user->id;

        Annonce::create([
            'titre' => $request->titre,
            'descriptif' => $request->descriptif,
            'image' => $data['image'],
            'etat' => $etat,
            'createur' =>$createur
            
        ]);

        return redirect()->route('mesAnnonces')
            ->with('succes_create_annonce', 'Vôtre annonce à été créee avec succés ! ');
    }

    public function update(Annonce $annonce, Request $request)
    {
        $request->validate([
            'titre' => 'required|max:150',
            'descriptif' => 'required|max:550',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'etat' => 'required'
        ]);

        $annonce->titre = $request->input('titre');
        $annonce->descriptif = $request->input('descriptif');
        $annonce->etat = $request->input('etat');


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!$image->getError()) {
                $annonce->image = $image->store('dossier_images', 'public');
            }
        }

        $annonce->save();

        return redirect()->route('mesAnnonces')
        ->with('succes_update_annonce', 'Annonce mise à jour avec succès !');
    }


    public function destroy($id)
    {
        $annonce = Annonce::find($id);
        if ($annonce) {
            $annonce->delete();
            return redirect()->route('mesAnnonces')->with('successSupression', 'Annonce supprimée avec succès.');
        } 
    }


}
