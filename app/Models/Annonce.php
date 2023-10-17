<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'titre',
        'image',
        'descriptif',
        'etat',
        'createur',
        'categorie_id'
    ];
    protected $primaryKey = 'id';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
    public function createur()
    {
        return $this->belongsTo(User::class, 'createur');
    }
}
