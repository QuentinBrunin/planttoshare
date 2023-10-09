<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{

    public function index()
    {
        $userId = session('user_id');
        return view('profil.MonProfilInfos', ['userId' => $userId]);
    }

    public function update(Request $request,$userId)
    {
        $data = $request->validate([
            'adresse' => 'required|max:550',
            'code_postal' => 'required|max:550',
            'ville' => 'required|max:250',
            
        ]);
        $user = User::findOrFail($userId);

        $user = User::findOrFail($userId);

        $user->adresse = $data['adresse'];
        $user->code_postal = $data['code_postal'];
        $user->ville = $data['ville'];

        $user->profil_completed = true;
        $user->save();

        return redirect()->route('InfosProfil')
        ->with('succes_update_profil', 'Votre profil a été mis à jour!');
    }
}
