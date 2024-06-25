<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = ['reference','couleur', 'imagereference']; 
    
    protected $table='references';


    public function vehicules()
    {
        return $this->hasMany(Vehicule::class, 'reference');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'couleur');
    }

    public function components() {
        return $this->hasMany(Component::class, 'reference'); // Relation avec les composants
    }
}
