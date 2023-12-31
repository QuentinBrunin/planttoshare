<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{
    public function completerProfil(){
        
        return view('profil.validationPremiereConnexion');
    }

    public function dashboard()
    {
        $userId = session('user_id');
        return view('profil.MonProfilDashboard', ['id' => $userId]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'adresse' => 'required|max:550',
            'code_postal' => 'required|max:550',
            'ville' => 'required|max:250',
            
        ]);
        $userId = session('user_id');

        $user = User::findOrFail($userId);

        $user->adresse = $data['adresse'];
        $user->code_postal = $data['code_postal'];
        $user->ville = $data['ville'];

        $user->save();

        return redirect()->route('dashboard_profil', ['id' => $userId])
        ->with('succes_update_profil', 'Votre profil a été mis à jour!');
    }
}
