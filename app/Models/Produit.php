<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'produit_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'utilisateur_id');
    }
    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'proprietaire');
    }
}
