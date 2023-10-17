<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

const API_URL = ('https://geo.api.gouv.fr/');
class ProfilController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return view('profil.profil', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'adresse' => 'required|max:550',
            'code_postal' => 'required|max:550',
            'ville' => 'required|max:250',
            'pseudo' =>'max:50'
        ]);

        $client = new Client([
            'base_uri' => 'https://geo.api.gouv.fr/',
            'verify' => false, // Désactiver la vérification du certificat SSL
        ]);

        // Vérification de la correspondance code postal - ville
        $code_postal = $request->input('code_postal');
        $ville = $request->input('ville');

        $response = $client->request('GET', 'communes?codePostal=' . $code_postal . '&fields=nom&format=json');
        $data = json_decode($response->getBody()->getContents(), true); // Convertir la réponse en tableau associatif
        $villes = [];

        foreach ($data as $item) {
            array_push($villes, $item['nom']);
        }

        if (!in_array($ville, $villes)) {
            return redirect()->route('InfosProfil')->with('error', 'Le code postal et la commune ne correspondent pas.');
        }

        $user->adresse = $request->input('adresse');
        $user->code_postal = $request->input('code_postal');
        $user->ville = $request->input('ville');
        $user->pseudo =$request->input('pseudo');

        if ($request->has('photo_profil')) {
            $user->photo_profil = $request->input('photo_profil');
        }

        $user->profil_completed = true;
        $user->save();

        return redirect()->route('InfosProfil')
            ->with('succes_update_profil', 'Votre profil a été mis à jour!');
    }
}
