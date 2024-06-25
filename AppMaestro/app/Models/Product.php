<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['marque','modele','couleur', 'creator','reference','annee','qtt_article','composants']; // Ajoutez la colonne 'imagecolor' ici
    

    public function marque()
    {
        return $this->belongsTo(Vehicule::class, 'marque');
    }

    public function modele()
    {
        return $this->belongsTo(Vehicule::class, 'modele');
    }

    public function couleur()
    {
        return $this->belongsTo(Color::class, 'couleur');
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference');
    }

    public function annee()
    {
        return $this->belongsTo(Vehicule::class, 'annee');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }
}
