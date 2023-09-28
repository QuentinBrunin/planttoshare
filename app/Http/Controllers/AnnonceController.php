<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;


class AnnonceController extends Controller
{
    public function index()
    {
        return view('forms.createAnnonce');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:150',
            'descriptif' => 'required|max:550',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'etat' => 'required'
        ]);
        if ($request->hasFile('image')) {
            // Vérifier si le fichier a été téléchargé correctement
            if ($request->file('image')->isValid()) {
                // Stocker le fichier uniquement s'il est valide
                $imagePath = $request->file('image')->store('dossier_images');
            } else {
                // Gérez l'erreur de fichier invalide ici
                dd("Le fichier n'est pas valide.");
            }
        } else {
            // Gérez le cas où aucun fichier n'a été téléchargé
            dd("Aucun fichier n'a été téléchargé.");
        }

        $etat = $request->input('etat');

        $annonce = Annonce::create([
            'titre' => $request->titre,
            'descriptif' => $request->descriptif,
            'image' => $imagePath,
            'etat' => $etat
            
        ]);

        return redirect()->route('createAnnonce')
            ->with('succes_create_annonce', 'Vôtre annonce à été créee avec succés ! ');
    }
}
