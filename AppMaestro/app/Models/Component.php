<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'name', 'quantity', 'unit']; // Champs remplissables
    

    public function reference() {
        
        return $this->belongsTo(Reference::class, 'reference'); // Relation avec 'vehicules'
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'reference', 'reference'); // Indiquer le champ de clé étrangère
    }
}
