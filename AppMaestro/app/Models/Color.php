<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['couleur', 'imagecolor']; // Ajoutez la colonne 'imagecolor' ici

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
    
    public function references()
    {
        return $this->hasMany(Reference::class, 'couleur');
    }

}
