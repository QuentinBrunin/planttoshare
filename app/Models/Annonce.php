<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    public function produits()
    {
        return $this->hasOne(Produit::class);
    }
    public function user()
    {
        return $this->belongsTo(Utilisateur::class, 'localisation');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function createur()
    {
        return $this->belongsTo(User::class, 'createur');
    }
}
