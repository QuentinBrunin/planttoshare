<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Categorie;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $categories = Categorie::all();
        $annonces = $user->annonces;

        return view('profil.annonces.index', ['annonces' => $annonces], ['categories' => $categories]);
    }
    public function create()
    {
        $categories = Categorie::all();
        return view('profil.annonces.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|max:150',
            'descriptif' => 'required|max:550',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'etat' => 'required',
            'categorie' => 'required'
        ]);

        $image = $data['image'];
        if ($image != null && !$image->getError()) {
            $data['image'] = $image->store('dossier_images', 'public');
        }

        $etat = $request->input('etat');
        $user = auth()->user();
        $createur = $user->id;

        Annonce::create([
            'titre' => $request->titre,
            'descriptif' => $request->descriptif,
            'image' => $data['image'],
            'etat' => $etat,
            'createur' => $createur,
            'categorie_id' => $request->categorie

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
            'etat' => 'required',
            'categorie' => 'required'
        ]);

        $annonce->titre = $request->input('titre');
        $annonce->descriptif = $request->input('descriptif');
        $annonce->etat = $request->input('etat');
        $annonce->categorie_id = $request->input('categorie');


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

    public function getFilteredAnnonces($category)
    {
        $filteredAnnonces = Annonce::whereHas('categorie', function ($query) use ($category) {
            $query->where('nom', $category);
        })->get();

        return response()->json($filteredAnnonces);
    }
}
