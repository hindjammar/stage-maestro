<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function affichecolors(){
        $colors = Color::all();
      return view('creator.result',compact('colors'));
 }

 public function ajoutcolor(Request $request){

    $request->validate([
      'couleur'=>'required|unique:colors,couleur',
      'imagecolor'=>'required|image'
    ]);

    if ($request->hasFile('imagecolor')) {
        $fileName = time() . $request->file('imagecolor')->getClientOriginalName();
        $path = $request->file('imagecolor')->storeAs('imagecolor', $fileName, 'public');
        $picturePath = Storage::url($path); // Utilisation de Storage::url() pour obtenir l'URL publique
    } else {
        $picturePath = null;
    }

    Color::create([
        'couleur'=> $request->couleur,
        'imagecolor' => $picturePath,
    ]);

    return redirect('/colors');

 }
}
