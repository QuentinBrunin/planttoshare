<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
