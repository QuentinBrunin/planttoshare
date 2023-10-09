<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{

    public function index(){
        return view('forms.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|max:150',
            'prenom'=>'required|max:150',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);

        $user = User::create([
            'nom' =>$request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

    
        return redirect()->route('login')
            ->with('succes_inscription','Vôtre demande de création de compte est acceptée,veuillez vous connecter ');
    }



}
