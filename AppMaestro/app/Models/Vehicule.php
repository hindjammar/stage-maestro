<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    
    protected $fillable = ['marque','modele','reference','marque_picture','modele_picture','couleur','annee', 'creator','status']; 
    
   

    public function color()
    {
        return $this->belongsTo(Color::class, 'couleur');
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference');
    }
    
    public function components()
    {
        // Définir une relation "hasMany" avec le champ de clé étrangère personnalisé
        return $this->hasMany(Component::class, 'reference', 'reference');
    }
}
